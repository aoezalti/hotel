ALTER TABLE users
    ADD `salutation` enum ('Ms.','Mr.','Mx.') NOT NULL;

ALTER TABLE news
    ADD thumbnailPath varchar(250) NOT NULL;
ALTER TABLE news
    ADD title varchar(250) NOT NULL;
ALTER TABLE reservations
    CHANGE status status ENUM ('new', 'confirmed', 'cancelled') NOT NULL;
ALTER TABLE rooms
    DROP COLUMN roomType;
ALTER TABLE rooms
    ADD `roomType` enum('single', 'double', 'deluxe') NOT NULL;

INSERT INTO rooms(maxRoomCount, pricePerNight,roomType) VALUES (1,50,'single');
INSERT INTO rooms(maxRoomCount,pricePerNight,roomType) VALUES (20,100,'double');
INSERT INTO rooms(maxRoomCount,pricePerNight,roomType) VALUES (5,150,'deluxe');
