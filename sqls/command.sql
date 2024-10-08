-- Drop Table Command
DROP TABLE IF EXISTS Admin_Ride;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Accessibility_Information;
DROP TABLE IF EXISTS Ride;
DROP TABLE IF EXISTS Park;

-- Create Table Command
CREATE TABLE Park (
    park_id INT PRIMARY KEY AUTO_INCREMENT,
    park_name VARCHAR(255),
    address VARCHAR(500)
);

CREATE TABLE Admin (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    password VARCHAR(255),
    park_name VARCHAR(255),
    park_id INT,
    FOREIGN KEY (park_id) REFERENCES Park(park_id)
);

CREATE TABLE Ride (
    ride_id INT PRIMARY KEY,
    ride_info VARCHAR(2000),
    park_name VARCHAR(255),
    physical_requirement VARCHAR(4000),
    ride_category VARCHAR(255),
    ride_name VARCHAR(255),
    park_id INT,
    FOREIGN KEY (park_id) REFERENCES Park(park_id)
);

CREATE TABLE Admin_Ride (
    ride_id INT,
    user_id INT,
    FOREIGN KEY (ride_id) REFERENCES Ride(ride_id),
    FOREIGN KEY (user_id) REFERENCES Admin(user_id)
);

CREATE TABLE Accessibility_Information (
    accessibility_id INT PRIMARY KEY AUTO_INCREMENT,
    ride_id INT,
    park_id INT,
    touch INT,
    taste INT,
    smell INT,
    sight INT,
    sound INT,
    pregnancy BOOLEAN,
    heart_disease BOOLEAN,
    blood_pressure BOOLEAN,
    intensity VARCHAR(255),
    wheelchair BOOLEAN,
    max_weight FLOAT,
    min_weight FLOAT,
    max_height FLOAT,
    min_height FLOAT,
    hands INT,
    legs INT,
    visual BOOLEAN,
    hearing BOOLEAN,
    flashing_light BOOLEAN,
    loud_noises BOOLEAN,
    intense_visual BOOLEAN,
    motion_sickness BOOLEAN,
    FOREIGN KEY (park_id) REFERENCES Park(park_id),
    FOREIGN KEY (ride_id) REFERENCES Ride(ride_id)
);

-- Insert Data Command
INSERT INTO Park (park_id, park_name, address) VALUES (1, 'Six Flags Over Texas', 'Arlington, TX');
INSERT INTO Park (park_id, park_name, address) VALUES (2, 'Disneyland', 'Disneyland Resort, Anaheim, CA');
INSERT INTO Park (park_id, park_name, address) VALUES (3, 'Central Park', 'Central Park, New York, NY');

INSERT INTO Admin (user_id, first_name, last_name, password, park_name, park_id) VALUES (1, 'John', 'Doe', 'password123', 'Six Flags Over Texas', 1);
INSERT INTO Admin (user_id, first_name, last_name, password, park_name, park_id) VALUES (2, 'Jane', 'Smith', 'admin123', 'Disneyland', 2);
INSERT INTO Admin (user_id, first_name, last_name, password, park_name, park_id) VALUES (3, 'Test1', 'Last1', 'password123', 'Central Park', 3);

INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (307,'Thrill', 'An exciting roller coaster with high speeds, steep drops, fast turns,and loops.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Shock Wave',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (507,'Thrill','An exciting, high speed, swing ride with circular motion.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recen t surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Texas SkyScreamer',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (113,'Thrill', 'Olympic bobsled simulation with medium side to side motion and mild up & down hills.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','La Vibora',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (506,'Thrill', 'An exciting roller coaster with high speeds, drops, fast turns, and loops', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Stay seated, face forward, keep head hands, and legs inside ride at all times. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Batman -- The Ride',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (225,'Family', 'Slow moving, sit down visual tour of the park.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Six Flags Railroad',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (230,'Thrill', 'An exciting roller coaster with high speeds, steep drops, and fast turns.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. There may not be more than a 4¼ inch gap between the lap bar and the side of the car.  Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Titan',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (415,'Kids', 'A child"s ride with elevation and short drops.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. No leg casts. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Bugs Bunny Cloud Bouncer',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (101,'Family','Low speed antique Carousel', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride. Expectant mothers and lap childrenar e only permitted when riding in a chariot.','Silver Star Carousel',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (306,'Family','Racecar simulation. Heavy side to side forces, minor bumping', 'Six Flags Over Texas','Drivers must exhibit sufficient visual acuity to operate the car safely. Drivers and passengers must maintain an upright seated position with their back against the seatback at all times during the ride durations. hands, hands, legs, and feet must remain inside the go kart at all times. Drivers and passengers must have the ability to step up and down into the ride vehicle or have the ability to transfer from a wheelchair to the go kart.','Six Flags Speedway (Go Karts)',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (310,'Thrill','An exciting ride with sudden vertical acceleration and a sudden vertical drop.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Superman: Tower of Power',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (416,'Kids','A gentle circular ride.', 'Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride. Lap children are not permitted. 275 pound maximum combined weight per swing.','Taz Tornado Swings',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (418,'Thrill','An interactive dark ride with turns and spins','Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. Lap seating is not permitted. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride. Strobe lights are in use.','Justice league Battle for Metropolis',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (427,'Family','A roller coaster for our smaller guests with mild drops and turns','Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Mini Mine Train',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (510,'Thrill','An exciting circular ride that has elevation and a tilt.','Six Flags Over Texas','Do not ride if you have any of the following conditions: recent surgery or illness, heart conditions, neck, back, or bone ailments, pregnancy, high blood pressure or aneurysms, or are under the influence of drugs or alcohol. All passenger restraints, including lap bars and seat belts, must be fastened properly to allow guest to ride. Due to the restraints some large guests may not be able to ride. Riders with arm casts must be seated with the cast toward the outside of the ride. All riders must be able to sit properly (facing forward, sitting upright, flat in the seat with their hands and legs inside the ride), use all restraining devices, and stabilize themselves throughout the entire ride cycle in order to ride.','Catwoman Whip',1);
INSERT INTO Ride (ride_id, ride_category, ride_info, park_name, physical_requirement, ride_name, park_id) VALUES (517,'Thrill','An exciting, high speed, free-fly coaster with drops and flips.', 'Six Flags Over Texas','Each rider must be able to remain sitting up straight, keep their head against the headrest, their back and shoulders against the seat back, and their hands, hands, legs, and feet inside the ride vehicle at all times. No Prosthetics. No leg casts Arm casts may not restrict the rider from bending the elbow and may not restrict the restraints in any way. Riders must be able to sit properly, use all restraining devices, and stabilize self. Riders using a wheelchair must transfer from the wheelchair onto the ride. Guest must be able to step up into ride unit.','The Joker',1);

INSERT INTO Admin_Ride (ride_id, user_id) VALUES (307,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (507,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (113,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (506,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (225,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (230,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (415,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (101,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (306,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (310,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (416,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (418,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (427,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (510,1);
INSERT INTO Admin_Ride (ride_id, user_id) VALUES (517,1);

INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (307,1,8,1,1,8,7,FALSE,TRUE,FALSE,'Mild',TRUE,400,100,90,42,1,2,FALSE,TRUE,FALSE,TRUE,TRUE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (507,1,7,1,1,6,5,TRUE,FALSE,FALSE,'Wild',FALSE,500,100,90,48,2,2,TRUE,FALSE,FALSE,FALSE,FALSE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (113,1,7,1,1,6,6,FALSE,TRUE,TRUE,'Mild',TRUE,650,110,80,42,2,2,FALSE,TRUE,FALSE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (506,1,8,1,1,7,8,TRUE,FALSE,FALSE,'Wild',FALSE,400,110,80,54,2,2,TRUE,FALSE,TRUE,FALSE,TRUE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (225,1,2,1,1,3,3,FALSE,FALSE,FALSE,'Low',TRUE,450,110,90,32,0,0,TRUE,FALSE,FALSE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (230,1,8,1,1,7,7,FALSE,TRUE,TRUE,'Wild',TRUE,500,110,80,48,1,2,FALSE,TRUE,FALSE,TRUE,TRUE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (415,1,3,1,1,3,3,TRUE,FALSE,FALSE,'Low',FALSE,600,100,90,32,1,1,FALSE,FALSE,TRUE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (101,1,3,1,1,3,2,FALSE,TRUE,FALSE,'Low',TRUE,600,110,80,42,0,0,TRUE,FALSE,FALSE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (306,1,5,1,3,5,5,TRUE,FALSE,TRUE,'Mild',FALSE,450,100,90,40,1,2,TRUE,FALSE,TRUE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (310,1,8,1,1,7,7,FALSE,TRUE,FALSE,'Wild',TRUE,500,110,80,52,1,1,FALSE,TRUE,FALSE,TRUE,TRUE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (416,1,3,1,1,3,3,FALSE,FALSE,FALSE,'Low',FALSE,400,100,80,22,1,1,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (418,1,5,1,1,6,5,FALSE,FALSE,TRUE,'Mild',TRUE,600,110,90,42,2,1,TRUE,FALSE,TRUE,TRUE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (427,1,5,1,1,4,4,TRUE,FALSE,FALSE,'Low',TRUE,500,100,90,54,2,2,FALSE,TRUE,TRUE,FALSE,FALSE,FALSE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (510,1,7,1,1,7,7,FALSE,FALSE,TRUE,'Wild',FALSE,600,120,80,48,2,2,TRUE,FALSE,FALSE,TRUE,TRUE,TRUE);
INSERT INTO Accessibility_Information (ride_id, park_id, touch, taste, smell, sight, sound, pregnancy, heart_disease, blood_pressure, intensity, wheelchair, max_weight, min_weight, max_height, min_height, hands, legs, visual, hearing, flashing_light, loud_noises, intense_visual, motion_sickness) VALUES (517,1,8,1,1,8,8,FALSE,TRUE,FALSE,'Wild',TRUE,300,120,80,54,1,2,FALSE,TRUE,TRUE,TRUE,FALSE,TRUE);