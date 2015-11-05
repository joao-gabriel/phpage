6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"127";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-12-15 08:51:20";s:13:"post_date_gmt";s:19:"2014-12-15 08:51:20";s:12:"post_content";s:8043:"Como primeiro passo para um "gameboy caseiro" tentei ir um pouco mais além do que um Hello World e resolvi já fazer um código de um jogo simples mas com os conceitos básicos de praticamente qualquer jogo: Sprites, colisões, som, movimento, recorde, etc.

<iframe style="min-height: 320px; width: 100%;" src="//www.youtube.com/embed/di9rDxOvoDs" width="300" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe>

Nos moldes do <a title="Gamebuino" href="http://gamebuino.com/" target="_blank">gamebuino.com</a> mas bem mais simples e com a vantagem de não vir pronto :P, segue abaixo o esquema elétrico do hardware:

<img class="alignnone size-full wp-image-144" src="http://localhost/phpage/wp-content/uploads/2014/12/Unsurreal11.png" alt="Unsurreal" width="821" height="636" />

E abaixo segue o código, bem direto e comentado, do primeiro jogo que eu já desenvolvi para o Arduino.

&nbsp;

[c]
#include &lt;Adafruit_GFX.h&gt;
#include &lt;Adafruit_PCD8544.h&gt;
#include &lt;EEPROM.h&gt;

// pin 7 - Serial clock out (SCLK)
// pin 6 - Serial data out (DIN)
// pin 5 - Data/Command select (D/C)
// pin 4 - LCD chip select (CS)
// pin 3 - LCD reset (RST)
Adafruit_PCD8544 display = Adafruit_PCD8544(7, 6, 5, 4, 3);

#define SHIP_W 8
#define SHIP_H 8

// Bitmaps
static unsigned char PROGMEM ship_bmp[] =
{ B00011000, 
  B00100100,
  B01000010, 
  B01011010,
  B10111101, 
  B10011001,
  B10111101, 
  B11100111 };
  
static unsigned char PROGMEM ufo_bmp[] =
{ B00000000, 
  B00000000,
  B00111100, 
  B01011010,
  B11100111, 
  B01011010,
  B00111100, 
  B00000000 };
  
static unsigned char PROGMEM shot_bmp[] =
{ B0110, 
  B0110,
  B0110, 
  B0110,
  B1001 };  
  

// button pins  
const int leftBtnPin = 2;
const int rightBtnPin = 8;
const int midBtnPin = 9;

// game variables
int ship_x = 10;

int shot_y = 0;
int shot_x = 0;

int ufo_x = 0;
int ufo_y = 0;
int ufo_dir = 1;
float ufo_vel = 1;
int ufo_y_delay = 8;
int change_dir = 50;

int lives = 3;
int score = 0;
int best = 0;

boolean started = false;

// Reset Function (send user to address 0 - start of program code in memory)
void(* resetFunc) (void) = 0;

// Sets up the hardware and text font
void setup()   {
  
  // Buttons
  pinMode(leftBtnPin, INPUT);
  pinMode(rightBtnPin, INPUT);
  pinMode(midBtnPin, INPUT);
  
  // Display
  Serial.begin(9600);
  display.begin();
  display.setContrast(55);

  // Font size and color (could only be black for 5110 LCD)
  display.setTextSize(1);
  display.setTextColor(BLACK);

}


void loop(){
  
  // Clear the screen
  display.clearDisplay();
  
  // Check if the game has started
  if (!started){
      // If not, shows the splashscreen and the highscore
      display.setCursor(13,13);
      display.println(&quot;HELLO UFO&quot;);
      display.print(&quot;  BEST:&quot;);
      
      // Read highscore from EEPROM (need to be converted from 2 bytes to Integer) 
      byte lowByte = EEPROM.read(0);
      byte highByte = EEPROM.read(1);
      best =  ((lowByte &lt;&lt; 0) &amp; 0xFF) + ((highByte &lt;&lt; 8) &amp; 0xFF00);
      
      display.println(best);
      display.display(); 
      delay(2000);
      while(digitalRead(midBtnPin) == LOW){
      } 
      started = true;
  } 
    
  // Show score at top left corner of display
  display.setCursor(0,0);
  display.println(score);    

  // Check if left button was pressed and the ship is within display limits
  if (digitalRead(leftBtnPin) == HIGH  &amp;&amp; ship_x &gt; 0) {
    
    // Decrease Ship X coordinate  
    ship_x--;
  } 

  // Check if right button was pressed and the ship is within display limits
  if (digitalRead(rightBtnPin) == HIGH &amp;&amp; ship_x &lt; 76) { 
    
    // Increase Ship X coordinate  
    ship_x++;
  } 

  // Check if shot button was pressed and if there is no other shot in the screen
  if (digitalRead(midBtnPin) == HIGH &amp;&amp; shot_y == 0){
    
    // Locate the shot Y coordinate just above the ship
    shot_y = 32;
    
    // Set the shot X coodinate as the same as the ship
    shot_x = ship_x;
    
    // Beep!
    tone(12, 440, 250);
  }
  
  // Check if the shot has to be drawn (shot Y coordinate is not 0)
  if (shot_y &gt; 0){  
    
    // Draw to shot at the framebuffer
    display.drawBitmap(shot_x, shot_y, shot_bmp, 8, 5, 1);
    
    // Decrease shot Y coordinate making it move upwards 
    shot_y--;
  }
  
  // Check if the shot hit the UFO
  if (
      shot_y&gt;0 &amp;&amp;                                  // Shot is being displayed? (this is necessary because the UFO could be at 0 Y coordinate)
      (ufo_y &gt;= shot_y &amp;&amp; ufo_y &lt;= (shot_y+5)) &amp;&amp;  // UFOs and shot Y coordinates + height intersect?
      (ufo_x &gt;= shot_x &amp;&amp; ufo_x &lt;= (shot_x+4))     // UFOs and shot X coordinates + width intersect?
      ){
        
    // Increase the score by 50 points minus the Y coordinate of the UFO
    // Nearer the top equals more points
    score = score + (50-shot_y);
    
    // Initialize the random number generator with the Y coordinate of the UFO at
    // the moment it was shot (just to keep things &quot;really random&quot;)
    randomSeed(shot_y);
    
    // Set the UFO X coordinate at some random point between 0 and 76
    ufo_x = random(76);
    
    // Set the UFO Y coordinate to the top of the screen
    ufo_y = 0;
    
    // Set the shot Y coordinate to 0 which disables it
    shot_y = 0;
    
    // Increase UFO horizontal speed in steps of ten
    ufo_vel = ufo_vel + 0.1;
    
    // If the chances of the UFO to change direction are greater than 2
    if (change_dir &gt; 2){
      
      // Decrease this chance 
      change_dir -= 1;
    }
    
    tone(12, 1000, 250);
    
  }
  
  // Refresh UFO X coordinate, considering its direction and horizontal speed
  ufo_x = ufo_x + (int)ufo_vel * ufo_dir;

  // By reaching the display bounderies or in one chance in [value in change_dir variable] the UFO change its horizontal direction
  if (ufo_x&gt;76 || ufo_x &lt; 0 || (random(change_dir) == 1)){
     ufo_dir = ufo_dir * -1;
   }
   
   // Each 8 horizontal pixels the UFO gets closer to the bottom
   ufo_y_delay--;
   if (ufo_y_delay&lt;1){
     ufo_y++;
     ufo_y_delay = 8;  
   }
   if (ufo_y&gt;48)
     ufo_y = 0;
   
   
  // Check collisions between the ship and the UFO OR if the UFO got passed the ship
  if ((ufo_y &gt; 32 &amp;&amp; (ufo_x &gt;= ship_x &amp;&amp; ufo_x &lt; ship_x + SHIP_W)) || (ufo_y &gt; 40)){
    lives--;
    tone(12, 100, 500);
    if (lives == 0){
      
      // Check if the score is higher than the best
      if (score &gt; best){
        // If it is, save it to the EEPROM (need to be converted from 2 bytes to Integer) 
        byte lowByte = ((score &gt;&gt; 0) &amp; 0xFF);
        byte highByte = ((score &gt;&gt; 8) &amp; 0xFF);
        EEPROM.write(0, lowByte);
        EEPROM.write(1, highByte);       
      }
      
      display.clearDisplay();
      display.setCursor(13,13);
      display.println(&quot;GAME OVER&quot;);
      display.print(&quot;  SCORE:&quot;);
      display.println(score);
      display.display(); 
      delay(2000);
      while(digitalRead(midBtnPin) == LOW){
      }
      resetFunc();
    }
    ufo_y = 0;
    display.clearDisplay();
    display.setCursor(13,13);
    display.print(&quot;LIVES: &quot;);
    display.println(lives);
    display.display();
    delay(2000);
  }
  
  display.drawBitmap(ufo_x, ufo_y,  ufo_bmp, SHIP_W, SHIP_H, 1);
  
  // ship display
  display.drawBitmap(ship_x, 40,  ship_bmp, SHIP_W, SHIP_H, 1);
  display.display();  
  delay(16);
  
}
[/c]

Segue o repositório do código no github:

<a title="Github" href="https://github.com/joao-gabriel/hello-ufo" target="_blank">https://github.com/joao-gabriel/hello-ufo</a>";s:10:"post_title";s:20:"Hello UFOsHello UFOs";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:10:"hello-ufos";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2015-10-24 16:14:17";s:17:"post_modified_gmt";s:19:"2015-10-24 16:14:17";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:31:"http://www.phpage.com.br/?p=127";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}