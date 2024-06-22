#include <SoftwareSerial.h>   
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define trigger D5
#define echo D6     
float times = 0;
int distance = 0;

// Replace with your network credentials
const char* ssid     = "WIFI E-BLOCK";
const char* password = "sece@123";

WiFiClient wifiClient;

void setup() {
  Serial.begin(115200);
  Serial.print("Connecting to ");
  Serial.println(ssid);
  pinMode(trigger, OUTPUT);
  pinMode(echo, INPUT);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  digitalWrite(trigger, LOW);
  delayMicroseconds(2);
  digitalWrite(trigger, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigger, LOW);
  delayMicroseconds(2);
  times = pulseIn(echo, HIGH);
  distance = times * 340 / 20000;

  Serial.println(distance);

  if (WiFi.status() == WL_CONNECTED) { // Check WiFi connection status
    HTTPClient http;  // Declare an object of class HTTPClient
    String url = "http://192.168.43.204/ultrasonic/data.php?cm=" + String(distance);
    
    http.begin(wifiClient, url);  // Specify request destination
    Serial.print("Requesting URL: ");
    Serial.println(url);
    
    int httpCode = http.GET();    // Send the request
    Serial.print("HTTP Code: ");
    Serial.println(httpCode);
    
    
    if (httpCode > 0) { // Check the returning code
      if (httpCode == HTTP_CODE_OK) { // HTTP code 200
        String payload = http.getString();   // Get the request response payload
        Serial.print("Response payload: ");
        Serial.println(payload);             // Print the response payload
      } else {
        Serial.print("Unexpected HTTP code: ");
        Serial.println(httpCode);
      }
    } else {
      Serial.print("Error on HTTP request: ");
      Serial.println(httpCode);
    }
    
    http.end();   // Close connection
  } else {
    Serial.println("WiFi not connected");
  }
 
  delay(1000);    // Send a request every second
}
