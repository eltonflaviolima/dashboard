#include <ESP8266WiFi.h>

#ifndef STASSID
#define STASSID "ELTON CASA"
#define STAPSK  "9b906123aa"
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "192.168.0.129";
float sensorPressao = 36;

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

  sensorPressao += 2;
  //=======================================================================================

  Serial.print("Conectando com: ");
  Serial.print(host);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;

  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("A conexao falhou!");
    delay(5000);
    return;
  }

  String url = "/nodemcu/salvar.php?";
          url += "sensorPressao=";
          url += sensorPressao;

  Serial.println("Requisitando URL: ");
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
  Serial.println("receiving from remote server");
  // not testing 'client.connected()' since we do not need to send data here
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  // Close the connection
  Serial.println();
  Serial.println("closing connection");
  client.stop();

  delay(10000); // execute once every 5 minutes, don't flood remote service
}
