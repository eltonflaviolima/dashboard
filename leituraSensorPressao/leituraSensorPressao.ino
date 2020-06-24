const int amostras = 10000;
const int pin = 13;

const float fator_atm = 0.0098692327;
const float fator_bar = 0.01;
const float fator_kgf_cm2 = 0.0101971621;

void setup() 
{
  pinMode(pin, INPUT);
  Serial.begin(115200);
}

void loop() 
{
  float medidas = 0.0;
  float pressao = 0.0;

  for (int i = 0; i < amostras; i++)
  {
    medidas = medidas +float(analogRead(A0)) - 0.2;
  }
  medidas = (medidas / float(amostras));

  pressao = calculaPressao(medidas);

  if (millis() > (5000))
  {
    Serial.println("-----------------------------------------");
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
    
  }
  else
  {
    Serial.println("SENSOR DE PRESSAO");
  }
  delay(1000);
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
