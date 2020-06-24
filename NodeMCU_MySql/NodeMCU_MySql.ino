#include <ESP8266WiFi.h>

#ifndef STASSID
#define STASSID "ELTON CASA"
#define STAPSK  "9b906123aa"
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "192.168.0.139"; //IP do servidor

const int amostras = 10000;
const float fator_atm = 0.0098692327;
const float fator_bar = 0.01;
const float fator_kgf_cm2 = 0.0101971621;

float mpx = 0;

void setup() {
  Serial.begin(115200);

  // We start by connecting to a WiFi network

  Serial.println();
  Serial.println();
  Serial.print("Conectando com ");
  Serial.println(ssid);

  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado");
  Serial.println("Endereco de IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  //=======================================================================================
  //  Espaço reservado para a leitura do sensor

        float medidas = 0.0;
        float pressao = 0.0;
      
        for (int i = 0; i < amostras; i++)
        {
          medidas = medidas +float(analogRead(A0)) - 0.2;
        }
        medidas = (medidas / float(amostras));
      
        pressao = calculaPressao(medidas);
      
        mpx = pressao;

        Serial.println("-----------------------------------------");
        Serial.println("LEITURAS DE PRESSÃO");
        Serial.print("Pressao: ");
        Serial.print(int(pressao));
        Serial.println("kPa");
        Serial.print("Pressao: ");
        Serial.print(int(pressao) * fator_atm);
        Serial.println("atm");
        Serial.print("Pressao: ");
        Serial.print(int(pressao) * fator_bar);
        Serial.println("bar");
        Serial.print("Pressao: ");
        Serial.print(int(pressao) * fator_kgf_cm2);
        Serial.println("kgf/cm²");
        Serial.print("Medidas: ");
        Serial.println(int(medidas));
        Serial.print("ADC: ");
        Serial.println(analogRead(A0));
        delay(1000);
  //=======================================================================================

  Serial.print("Enviando para: ");
  Serial.println(host);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;

  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("A conexao falhou!");
    return;
  }

  String url = "/nodemcu/dashboard/salvar.php?";
          url += "mpx=";
          url += mpx;

  Serial.print("Requisitando URL: ");
  Serial.println(url);
 
  client.print(String("GET ") + url + "HTTP/1.1\r\n" +
                "Host: " + host + "\r\n" +
                "Connection: close\r\n\r\n");

  // wait for data to be available
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      delay(60000);
      return;
    }
  }

  // Read all the lines of the reply from server and print them to Serial
  Serial.println("Reposta recebida do servidor remoto:");
  Serial.print(mpx);
  Serial.println("kPa");
  // not testing 'client.connected()' since we do not need to send data here
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  // Close the connection
  Serial.println();
  Serial.println("Fechando conexão");
  client.stop();

  delay(10000)); // execute once every 5 minutes, don't flood remote service
}

float calculaPressao (float medida)
{
  return ((corrigeMedida(medida) / 3.3) - 0.04) / 0.0012858;
}

float corrigeMedida(float x)
{
  return 4.821224180510e-02
  + 1.180826610901e-03 * x
  + -6.640183463236e-07 * x * x
  + 5.23553259767e-10 * x * x * x
  + -2.020362971028e-13 * x * x * x * x
  + 3.809807883001e-17 * x * x * x * x * x
  + -2.896158699016e-21 * x * x * x * x * x * x; 
}
