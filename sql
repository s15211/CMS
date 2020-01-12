
-- User setup

INSERT INTO User (email,password,first_name,last_name) 
	VALUES 
    ('s15183@pjwstk.edu.pl','Password1','Dawid','Piotrak'),
    ('s15211@pjwstk.edu.pl','Password1','Mateusz','Hefner'),
    ('s15444@pjwstk.edu.pl','Password1','Arthur','Shkred');

-- Car setup
Insert Into car VALUES
    (1),
    (2),
    (3);

-- Article setup

INSERT INTO Post (title,content,date,author_id,car_id) VALUES
	(
            'BMW M3 review - still the sports saloon king?',
            'Despite being based on BMW’s mid-sized, practical 3-series the M3 has become a fundamental part of the performance car world. A trackday or Nurburgring tourist day 					 wouldn’t be complete without at least one M3. Only the first of the breed, the E30 M3, had any real racing pedigree but in the intervening 31 years the M3 has become 					 faster and more impressive. Now, irrespective of its saloon underpinnings, the M3 has the performance and handling poise to worry any unprepared supercar driver.
            However this model, know as the F80, is different in many ways to the M3s of old. To begin with it’s the first M3 to be a four-door only. That’s because BMW’s model range              has changed, and what was once the 3-series coupe has become the 4-series. Consequently, the M3 coupe is now the M4.',
            NOW(),
            1,
            1
    ),

    (
        '2020 Shelby Super Snake Bold Package Revealed With Retro Colors',
        'Shelby American has been keeping itself quite busy lately with the F-150 Super Snake Sport and the GT500 Dragon Snake, and now it’s turning its attention to another Mustang. Starting off with the Super Snake version of its supercharged ‘Stang, the new Bold Package comes in three different paint schemes harkening back to the most popular colors used by the company during the 1970s.',
        NOW(),
        2,
        2
    ),

    (
        'See The 2020 Audi RS7 Sportback Hit 62 MPH In 3.4 Seconds',
        'It’s a known fact that German automakers are being overly cautious when it comes to publishing performance numbers of their vehicles, and Audi is no exception. Case in point, the official press release for the new RS7 might say the gorgeous Sportback needs 3.6 seconds for the 0-62 mph (0-100 kph) sprint, but Audi’s own Virtual Cockpit shows a 3.4s time in a real-life test conducted in southern Germany.
        According to Motor1.com long-time collaborator Auditography, this lovely Glacier White example actually had a Vbox mounted inside to accurately grab all the juicy performance numbers. It completed the sprint in 3.4 seconds “pretty much anytime, anyplace” with the launch control turned on. Interestingly, the best run was clocked in at only 3.38s, making it comparable to the old R8 V10 Plus. The journey from a standstill to 124 mph (200 kph) took 11.9 seconds or a tenth of a second less than Audi’s numbers.',
        NOW(),
        3,
        3
    );
