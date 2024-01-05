ALTER TABLE users
  ADD `salutation` enum('Ms.','Mr.','Mx.') NOT NULL;

  ALTER TABLE news
    ADD thumbnailPath varchar(250) NOT NULL;
  ALTER TABLE news
    ADD title varchar(250) NOT NULL;
  