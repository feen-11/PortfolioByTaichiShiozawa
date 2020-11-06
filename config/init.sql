
-- データベース構造
-- テーブル作成
create table users (
  userId int not null auto_increment primary key,
  email varchar(191),
  name varchar(191),
  password varchar(191),
  declaration text,
  age int,
  sex varchar(191),
  height int,
  weight int,
  goalWeight int,
  nowWeight int,
  created date,
  updated date
);

create table food (
  foodId int not null auto_increment primary key,
  timeflame varchar(191),
  foodName varchar(191),
  calorie int,
  created date,
  updated date,
  userId int 
);

create table training(
  trainingId int not null auto_increment primary key,
  trainingName varchar(191),
  burnCalorie int,
  created date,
  updated date,
  userId int
);

create table posts(
  postId int not null auto_increment primary key,
  body varchar(191),
  created date,
  updated date,
  userId int
);

create table logindateinfo(
  loginDay date,
  dayWeight int,
  userId int
);


 








