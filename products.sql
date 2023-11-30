BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "products" (
	"id"	INTEGER,
	"name"	TEXT,
	"description"	TEXT,
	"price"	REAL,
	PRIMARY KEY("id")
);
INSERT INTO "products" VALUES (1,'Weighted Jump Rope','Enhance your cardio with a durable weighted jump rope.',14.99);
INSERT INTO "products" VALUES (2,'Adjustable Dumbbells','Versatile dumbbell set with adjustable weights for various exercises.',129.99);
INSERT INTO "products" VALUES (3,'Yoga Mat','High-quality non-slip yoga mat for comfortable workouts.',24.99);
INSERT INTO "products" VALUES (4,'Resistance Bands','Set of resistance bands for strength training and flexibility.',19.99);
INSERT INTO "products" VALUES (5,'Kettlebell Set','Durable kettlebell set for full-body workouts.',49.99);
INSERT INTO "products" VALUES (6,'Foam Roller','Relieve muscle tension with a textured foam roller.',19.99);
INSERT INTO "products" VALUES (7,'Ab Roller','Strengthen your core with a sturdy ab roller.',29.99);
INSERT INTO "products" VALUES (8,'Elliptical Bike','2-in-1 elliptical and stationary bike for a complete workout.',299.99);
INSERT INTO "products" VALUES (9,'Pull-Up Bar','Easily installable pull-up bar for upper body strength training.',34.99);
INSERT INTO "products" VALUES (10,'Weight Bench','Adjustable weight bench for various strength exercises.',89.99);
INSERT INTO "products" VALUES (11,'Treadmill','Foldable treadmill with speed and incline settings.',599.99);
INSERT INTO "products" VALUES (12,'Boxing Gloves','Premium boxing gloves for sparring and bag workouts.',49.99);
INSERT INTO "products" VALUES (13,'Pilates Ball','Anti-burst pilates ball for core strengthening exercises.',16.99);
INSERT INTO "products" VALUES (14,'Medicine Ball Set','Durable medicine ball set for dynamic workouts.',39.99);
INSERT INTO "products" VALUES (15,'Cycling Trainer','Indoor cycling trainer for realistic bike workouts.',199.99);
INSERT INTO "products" VALUES (16,'Push-Up Handles','Ergonomic push-up handles for wrist comfort.',14.99);
INSERT INTO "products" VALUES (17,'Hexagonal Dumbbells','Hex-shaped dumbbells for stability during lifts.',49.99);
INSERT INTO "products" VALUES (18,'Fitness Tracker','Smart fitness tracker to monitor your workouts.',79.99);
INSERT INTO "products" VALUES (19,'Rowing Machine','Compact rowing machine for effective cardio.',249.99);
INSERT INTO "products" VALUES (20,'Battle Ropes','Heavy-duty battle ropes for intense full-body workouts.',54.99);
INSERT INTO "products" VALUES (21,'Plyometric Box','Sturdy plyometric box for explosive jump training.',79.99);
INSERT INTO "products" VALUES (22,'Weighted Vest','Adjustable weighted vest for added resistance.',44.99);
INSERT INTO "products" VALUES (23,'TRX Suspension Trainer','Versatile TRX system for bodyweight exercises.',69.99);
INSERT INTO "products" VALUES (24,'Climbing Rope','Durable climbing rope for a challenging upper body workout.',39.99);
INSERT INTO "products" VALUES (25,'Gymball Chair','Stability ball chair for improved posture.',64.99);
INSERT INTO "products" VALUES (26,'Fitness Gloves','Breathable fitness gloves for weightlifting.',19.99);
INSERT INTO "products" VALUES (27,'Multi-Station Home Gym','Compact home gym with multiple exercise stations.',699.99);
INSERT INTO "products" VALUES (28,'Hula Hoop','Weighted hula hoop for a fun and effective workout.',24.99);
INSERT INTO "products" VALUES (29,'Power Rack','Heavy-duty power rack for safe and efficient lifting.',349.99);
INSERT INTO "products" VALUES (30,'Boxing Reflex Ball','Reflex ball for boxing training and hand-eye coordination.',14.99);
INSERT INTO "products" VALUES (31,'Suspension Yoga Swing','Yoga swing for aerial yoga and flexibility training.',89.99);
INSERT INTO "products" VALUES (32,'Ankle Weights','Adjustable ankle weights for targeted leg workouts.',19.99);
INSERT INTO "products" VALUES (33,'Punching Bag','Heavy-duty punching bag for boxing and kickboxing.',79.99);
INSERT INTO "products" VALUES (34,'Spinning Bike','Commercial-grade spinning bike for intense cycling sessions.',499.99);
INSERT INTO "products" VALUES (35,'Weighted Sandbag','Versatile sandbag for functional strength training.',34.99);
INSERT INTO "products" VALUES (36,'Stability Disc','Inflatable stability disc for balance and core exercises.',12.99);
INSERT INTO "products" VALUES (37,'Mini Stepper','Compact mini stepper for low-impact cardiovascular exercise.',69.99);
INSERT INTO "products" VALUES (38,'Weightlifting Belt','Supportive weightlifting belt for safe heavy lifting.',29.99);
INSERT INTO "products" VALUES (39,'Massage Foam Roller','Vibrating foam roller for muscle recovery and relaxation.',79.99);
INSERT INTO "products" VALUES (40,'Pilates Reformer','Professional pilates reformer for comprehensive workouts.',899.99);
INSERT INTO "products" VALUES (41,'Adjustable Weighted Vest','Customizable weighted vest for progressive resistance.',54.99);
INSERT INTO "products" VALUES (42,'Grip Strengthener','Hand grip strengthener for forearm and hand strength.',9.99);
INSERT INTO "products" VALUES (43,'Leg Press Machine','Compact leg press machine for lower body strength.',449.99);
INSERT INTO "products" VALUES (44,'Agility Ladder','Durable agility ladder for speed and coordination drills.',16.99);
INSERT INTO "products" VALUES (45,'Pec Deck Machine','Pec deck machine for isolating chest muscles.',299.99);
INSERT INTO "products" VALUES (46,'Yoga Block Set','High-density yoga block set for yoga and stretching.',19.99);
INSERT INTO "products" VALUES (47,'Dip Station','Stable dip station for effective tricep and chest exercises.',89.99);
INSERT INTO "products" VALUES (48,'Wrist Roller','Wrist roller for forearm and grip strength development.',24.99);
INSERT INTO "products" VALUES (49,'Calf Raise Machine','Calf raise machine for targeted calf muscle workouts.',129.99);
COMMIT;
