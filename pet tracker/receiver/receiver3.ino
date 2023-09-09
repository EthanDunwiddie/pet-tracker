#include <WiFi.h> 
#include <SPI.h>
#include <LoRa.h>
#include <ThingSpeak.h>

// define the pins used by the receiver
#define ss 5
#define rst 14
#define dio0 2

// Network ssid and password
const char* ssid = ""; // hidden for security
const char* password = ""; // hidden for security

WiFiClient client;

// thingspeak channel id and write api key
unsigned long channel_id = 2000931;
const char * write_api_key = ""; // hidden for security

void setup() 
{
  // initialize Serial Monitor
  Serial.begin(9600);
  while (!Serial);
  Serial.println("LoRa Receiver");

  // setup LoRa transceiver module
  LoRa.setPins(ss, rst, dio0);

  while (!LoRa.begin(868.4E6))
  {
    Serial.println(".");
    delay(500);
  }
  // sync word matches the receiver
  // the sync word assures you don't get LoRa messages from other LoRa Transceivers
  // ranaged from 0-0xFF
  LoRa.setSyncWord(0xF3);
  Serial.println("LoRa Initializing OK!");

  // call function to connect to WIFI
  initWiFi();

  // initialize thingspeak 
  ThingSpeak.begin(client);
}

void loop() 
{
  String message = "";
    
  // try to parse packet
  int packetSize = LoRa.parsePacket();
  if(packetSize)
  {
    // received a packet
    Serial.println("Received packet.. ");
  
    // read packet
    while (LoRa.available())
    {
      message += (char)LoRa.read();
    }
    Serial.println(message);
    Serial.println("");

    // if location data is sent correctly, do this
    if (message.indexOf("la:") != -1 && message.indexOf("lo:") != -1)
    {
      String latitude = message.substring(18,28); 
      String longitude = message.substring(3,13); 

      Serial.print("lat:");
      Serial.println(latitude);
      Serial.print("lng:");
      Serial.println(longitude);

      // removes new lines
      longitude.replace("\n", "");
      latitude.replace("\n", "");

      delay(200);

      ThingSpeak.setField(1, longitude);
      ThingSpeak.setField(2, latitude);

      // if speed was sent correctly, do this
      if (message.indexOf("s:") != -1)
      {
        // if speed data is in the message do this
        String speed = message.substring(51, message.length()); 
        speed.replace(":", ""); // removes colon from speed
        ThingSpeak.setField(3, speed);
        Serial.print("speed:");
        Serial.println(speed);
        Serial.println("");
      }
      // write fields
      ThingSpeak.writeFields(channel_id, write_api_key);
    
      // 15 seconds delay due to ThingSpeak cooldown
      delay(15000);
    } else 
    {
      // location data hasnt sent correctly, data is corrupted, or theres another error
      Serial.println("An error has occured");
    }
  }
}

// establishes connection to WIFI
void initWiFi()
{
  WiFi.mode(WIFI_STA);
  Serial.print("Connecting to WiFi..");
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    WiFi.begin(ssid, password);
    delay(1000);
  }
  Serial.println(".Connected");
}


