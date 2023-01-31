#include <SPI.h>
#include <NMEAGPS.h>
#include <NeoSWSerial.h>
#include <LoRa.h>

// define pins
#define ss 10
#define rst 9
#define dio0 2
#define RXPin 0
#define TXPin 1

NeoSWSerial gpsPort(RXPin, TXPin);
NMEAGPS gps;
gps_fix fix;
int fixCount = 0;
float lat, lng, alti = 0;
float speed = 0;

int counter = 0;

void setup() 
{
  // initialize Serial Monitor
  Serial.begin(9600);
  gpsPort.begin(9600);
  delay(500);

  while(!Serial);
  Serial.println("LoRa Sender");

  // setup LoRa transmitter
  LoRa.setPins(ss, rst, dio0);

  // sets LoRa device to 868mhz
  while(!LoRa.begin(868.4E6))
  {
    Serial.println(".");
    delay(500);
  }

  // set power to 20   
  LoRa.setTxPower(20);

  // sync assuring theres no LoRa messages from other devices
  LoRa.setSyncWord(0xF3);
  Serial.println("LoRa Iitializing OK!");

}

void loop() 
{
  // send gps data
  Serial.println("Loading..");
  while (gps.available(gpsPort))  
  {
    Serial.println("Sending packet...");
    fix = gps.read();
    sendGpsData();
    delay(16000);
    counter++;
  } 
}

void sendGpsData()
{
  if (fix.valid.location)
  {
    lat = (fix.latitude());
    lng = (fix.longitude());
    Serial.println("Sending...");

    LoRa.beginPacket();
    delay(100);
    LoRa.print("lo:");
    LoRa.println(lng,7);
    LoRa.print("la:");
    LoRa.println(lat,7);
    Serial.print("packet ");
    Serial.println(counter);
    LoRa.print("packet number: ");
    LoRa.println(counter);

    if (fix.valid.speed)
    {
      speed = fix.speed_mph();
      LoRa.print("s:");
      LoRa.print(speed);
    }
    LoRa.endPacket();

    Serial.println("Sent");
  }
}

