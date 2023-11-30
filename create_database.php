<?php
$db = new SQLite3('webshop.db');

$db->exec('
  CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY,
    name TEXT,
    description TEXT,
    price REAL
  )
');

$products = [
    ["Weighted Jump Rope", "Enhance your cardio with a durable weighted jump rope.", 14.99],
    ["Adjustable Dumbbells", "Versatile dumbbell set with adjustable weights for various exercises.", 129.99],
    ["Yoga Mat", "High-quality non-slip yoga mat for comfortable workouts.", 24.99],
    ["Resistance Bands", "Set of resistance bands for strength training and flexibility.", 19.99],
    ["Kettlebell Set", "Durable kettlebell set for full-body workouts.", 49.99],
    ["Foam Roller", "Relieve muscle tension with a textured foam roller.", 19.99],
    ["Ab Roller", "Strengthen your core with a sturdy ab roller.", 29.99],
    ["Elliptical Bike", "2-in-1 elliptical and stationary bike for a complete workout.", 299.99],
    ["Pull-Up Bar", "Easily installable pull-up bar for upper body strength training.", 34.99],
    ["Weight Bench", "Adjustable weight bench for various strength exercises.", 89.99],
    ["Treadmill", "Foldable treadmill with speed and incline settings.", 599.99],
    ["Boxing Gloves", "Premium boxing gloves for sparring and bag workouts.", 49.99],
    ["Pilates Ball", "Anti-burst pilates ball for core strengthening exercises.", 16.99],
    ["Medicine Ball Set", "Durable medicine ball set for dynamic workouts.", 39.99],
    ["Cycling Trainer", "Indoor cycling trainer for realistic bike workouts.", 199.99],
    ["Push-Up Handles", "Ergonomic push-up handles for wrist comfort.", 14.99],
    ["Hexagonal Dumbbells", "Hex-shaped dumbbells for stability during lifts.", 49.99],
    ["Fitness Tracker", "Smart fitness tracker to monitor your workouts.", 79.99],
    ["Rowing Machine", "Compact rowing machine for effective cardio.", 249.99],
    ["Battle Ropes", "Heavy-duty battle ropes for intense full-body workouts.", 54.99],
    ["Plyometric Box", "Sturdy plyometric box for explosive jump training.", 79.99],
    ["Weighted Vest", "Adjustable weighted vest for added resistance.", 44.99],
    ["TRX Suspension Trainer", "Versatile TRX system for bodyweight exercises.", 69.99],
    ["Climbing Rope", "Durable climbing rope for a challenging upper body workout.", 39.99],
    ["Gymball Chair", "Stability ball chair for improved posture.", 64.99],
    ["Fitness Gloves", "Breathable fitness gloves for weightlifting.", 19.99],
    ["Multi-Station Home Gym", "Compact home gym with multiple exercise stations.", 699.99],
    ["Hula Hoop", "Weighted hula hoop for a fun and effective workout.", 24.99],
    ["Power Rack", "Heavy-duty power rack for safe and efficient lifting.", 349.99],
    ["Boxing Reflex Ball", "Reflex ball for boxing training and hand-eye coordination.", 14.99],
    ["Suspension Yoga Swing", "Yoga swing for aerial yoga and flexibility training.", 89.99],
    ["Ankle Weights", "Adjustable ankle weights for targeted leg workouts.", 19.99],
    ["Punching Bag", "Heavy-duty punching bag for boxing and kickboxing.", 79.99],
    ["Spinning Bike", "Commercial-grade spinning bike for intense cycling sessions.", 499.99],
    ["Weighted Sandbag", "Versatile sandbag for functional strength training.", 34.99],
    ["Stability Disc", "Inflatable stability disc for balance and core exercises.", 12.99],
    ["Mini Stepper", "Compact mini stepper for low-impact cardiovascular exercise.", 69.99],
    ["Weightlifting Belt", "Supportive weightlifting belt for safe heavy lifting.", 29.99],
    ["Massage Foam Roller", "Vibrating foam roller for muscle recovery and relaxation.", 79.99],
    ["Pilates Reformer", "Professional pilates reformer for comprehensive workouts.", 899.99],
    ["Adjustable Weighted Vest", "Customizable weighted vest for progressive resistance.", 54.99],
    ["Grip Strengthener", "Hand grip strengthener for forearm and hand strength.", 9.99],
    ["Leg Press Machine", "Compact leg press machine for lower body strength.", 449.99],
    ["Agility Ladder", "Durable agility ladder for speed and coordination drills.", 16.99],
    ["Pec Deck Machine", "Pec deck machine for isolating chest muscles.", 299.99],
    ["Yoga Block Set", "High-density yoga block set for yoga and stretching.", 19.99],
    ["Dip Station", "Stable dip station for effective tricep and chest exercises.", 89.99],
    ["Wrist Roller", "Wrist roller for forearm and grip strength development.", 24.99],
    ["Calf Raise Machine", "Calf raise machine for targeted calf muscle workouts.", 129.99],
];

foreach ($products as $product) {
    $name = $product[0];
    $description = $product[1];
    $price = $product[2];

    $query = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', $price)";
    $db->exec($query);
}

$db->close();
?>
