#!/usr/bin/env python3


import mysql.connector
import time
from bme280 import BME280
import ST7735
from enviroplus.noise import Noise




#connect to database
mydb = mysql.connector.connect(
  host="piasvg.mysql.database.azure.com",
  user="muffins",
  password="Maffins2022",
  database="muffins"
)

mycursor = mydb.cursor()

noise = Noise()

disp = ST7735.ST7735(
    port=0,
    cs=ST7735.BG_SPI_CS_FRONT,
    dc=9,
    backlight=12,
    rotation=90)

disp.begin()


try:
    # Transitional fix for breaking change in LTR559
    from ltr559 import LTR559
    ltr559 = LTR559()
except ImportError:
    import ltr559


try:
    from smbus2 import SMBus

except ImportError:
    from smbus import SMBus


import logging

logging.basicConfig(
    format='%(asctime)s.%(msecs)03d %(levelname)-8s %(message)s',
    level=logging.INFO,
    datefmt='%Y-%m-%d %H:%M:%S')

logging.info("""weather.py - Print readings from the BME280 weather sensor.

Press Ctrl+C to exit!

""")
lux = ltr559.get_lux()

bus = SMBus(1)
bme280 = BME280(i2c_dev=bus)

def get_cpu_temperature():
    with open("/sys/class/thermal/thermal_zone0/temp", "r") as f:
        temp = f.read()
        temp = int(temp) / 1000.0
    return temp
# Tuning factor for compensation. Decrease this number to adjust the
# temperature down, and increase to adjust up
factor = 2.25

cpu_temps = [get_cpu_temperature()] * 5

while True:

    lux = ltr559.get_lux()
    print (lux)

    low, mid, high, amp = noise.get_noise_profile()
    low *= 128
    mid *= 128
    high *= 128
    amp *= 64
    amp = float(amp)
    print ("this is the amp", amp)
    cpu_temp = get_cpu_temperature()
    # Smooth out with some averaging to decrease jitter
    cpu_temps = cpu_temps[1:] + [cpu_temp]
    avg_cpu_temp = sum(cpu_temps) / float(len(cpu_temps))
    raw_temp = bme280.get_temperature()
    comp_temp = raw_temp - ((avg_cpu_temp - raw_temp) / factor)

    pressure = bme280.get_pressure()
    humidity = bme280.get_humidity()
   
    #Insert data
    sql = (f"INSERT INTO sensor_data(temprature, pressure, humidity, classroom_id, light, sound) VALUES ({comp_temp}, {pressure}, {humidity}, 352, {lux}, {amp})")
    mycursor.execute(sql)
    mydb.commit()
    print(mycursor.rowcount, "row inserted")
    

    logging.info("""
Pressure: {:05.2f} hPa
Relative humidity: {:05.2f} %
""".format( pressure, humidity))
    print(comp_temp)
    
    
    time.sleep(10)