SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `tUser` (

  `user_id`                 int NOT NULL AUTO_INCREMENT,
  `user_name`               varchar(25) NOT NULL,
  `user_last_name`          varchar(25) NOT NULL,
  `user_mail`               varchar(25) NOT NULL,
  `user_pw`                 varchar(50) NOT NULL,
  `user_address`            varchar(50) NOT NULL,
  `user_post_code`          int(5) NOT NULL,
  `user_phone`              int(15) NOT NULL,
  `user_details`            varchar(200) DEFAULT NULL,
  `user_role`               ENUM('teacher', 'student', 'admin', 'dev'),
  PRIMARY KEY (`user_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tSubject` (

  `subject_id`                 int NOT NULL AUTO_INCREMENT,
  `subject_name`               varchar(25) NOT NULL,
  `subject_details`            varchar(250) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tResource` (

  `resource_id`                 int NOT NULL AUTO_INCREMENT,
  `resource_type`               ENUM('audio', 'video', 'text', 'web'),
  `resource_url`                text NOT NULL,
  `resource_details`            varchar(250) DEFAULT NULL,
  PRIMARY KEY (`resource_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tTask` (

  `task_id`                 int NOT NULL AUTO_INCREMENT,
  `task_group_id`           int NOT NULL,
  `task_name`               varchar(25) NOT NULL,
  `task_release_date`       datetime NOT NULL,
  `task_due_date`           datetime NOT NULL,
  `task_content`            int NOT NULL,
  `task_questions`          text NOT NULL,
  PRIMARY KEY (`task_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tGroup` (

  `group_entry_id`            int NOT NULL AUTO_INCREMENT,
  `group_id`                  int NOT NULL,
  `group_subject_id`          int NOT NULL,
  `group_handle`              int NOT NULL,
  `group_member`              int NOT NULL,
  PRIMARY KEY (`group_entry_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tHandover` (

  `handover_id`               int NOT NULL AUTO_INCREMENT,
  `handover_author_id`        int NOT NULL,
  `handover_task_id`          int NOT NULL,
  `handover_date`             datetime NOT NULL,
  `handover_content`          text NOT NULL,
  PRIMARY KEY (`handover_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tNotif` (

  `notif_id`                  int NOT NULL AUTO_INCREMENT,
  `notif_type`                ENUM('solicitud', 'aviso'),
  `notif_content`             text NOT NULL,
  PRIMARY KEY (`notif_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE USER 'foreigner'@'ile---proyect-www-1.ile---proyect_default' IDENTIFIED BY 'test';
GRANT INSERT ON `ILE_DB`.`tNotif` TO 'foreigner'@'ile---proyect-www-1.ile---proyect_default';
ALTER USER 'foreigner'@'ile---proyect-www-1.ile---proyect_default';


-- Test Data

INSERT INTO `tUser` 
(`user_id`, `user_name`, `user_last_name`, `user_mail`, `user_pw`, `user_address`, `user_post_code`, `user_phone`, `user_details`, `user_role`) 
VALUES 
(NULL, 'Dev1', 'desarrollo', 'dev@dev.com', '1111', 'C/Aqui', '33600', '323154987', 'Desarrollador Prueba', 'dev'),
(NULL, 'Admin1', 'admin', 'ad@ad.com', '3333', 'C/Quimismo', '33600', '653236985', 'Administrador Prueba', 'admin'),
(NULL, 'Teacher1', 'prof', 'prof@prof.com', '2222', 'C/Alli', '33600', '987654321', 'Profesor Prueba', 'teacher'),
(NULL, 'Student1', 'stud', 'stu@stu.com', '4444', 'C/Bajolpuente', '33600', '258963258', 'Estudiante Prueba', 'student'),
(NULL, 'Student2', 'stud', 'stu2@stu2.com', '5555', 'C/Sobrelpuente', '33600', '452168975', 'Estudiante Prueba 2', 'student');

INSERT INTO `tGroup` 
(`group_entry_id`, `group_id`, `group_subject_id`, `group_handle`, `group_member`) 
VALUES 
(NULL, '1', '1', '3', '4'), 
(NULL, '1', '1', '3', '5');

INSERT INTO `tResource` 
(`resource_id`, `resource_type`, `resource_url`, `resource_details`) 
VALUES 
(NULL, 'video', 'https://www.youtube.com/embed/1IyU3VXDAIk', 'Video de Cancion');

INSERT INTO `tTask` 
(`task_id`, `task_group_id`, `task_name`, `task_release_date`, `task_due_date`, `task_content`, `task_questions`) 
(NULL, '1', 'Probar', '2022-06-07 18:38:03', '2022-06-23 20:38:04', '1', '[\"Eso\", \"Aquello\"]'),
(NULL, '2', 'Probar Again', '2022-06-07 18:38:03', '2022-06-23 20:38:04', '1', '[\"Eso\", \"Aquello\"]');