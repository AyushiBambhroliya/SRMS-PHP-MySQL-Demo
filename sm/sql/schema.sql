CRETAE DATABASE IF NOT EXISTS student_result;
use student_result;

-- -------------------------
-- 1. Student Table
-- -------------------------


create table student (
  id int primary key auto_increment,
   name varchar(50),
    age int,
     city varchar(50)
);

-- -------------------------
-- 2. Subjects Table
-- -------------------------
CREATE TABLE subjects (
    sub_id INT PRIMARY KEY AUTO_INCREMENT,
    sub_name VARCHAR(50)
);



-- -------------------------
-- 3. Marks Table
-- -------------------------
CREATE TABLE marks (
    mark_id INT PRIMARY KEY AUTO_INCREMENT,
    sid INT,
    sub_id INT,
    marks INT,
    FOREIGN KEY (sid) REFERENCES student(id),
    FOREIGN KEY (sub_id) REFERENCES subjects(sub_id)
);



-- -------------------------
-- 4. Fees Table (for Transactions)
-- -------------------------
CREATE TABLE fees (
    fee_id INT PRIMARY KEY AUTO_INCREMENT,
    sid INT,
    amount INT,
    status VARCHAR(20),
    FOREIGN KEY (sid) REFERENCES student(id)
);



-- -------------------------
-- VIEW: Result Summary
-- -------------------------

create view result_view as 
select s.id, s.name,
    sum(m.marks) as total,
    round(avg(m.marks),2) as percentage
from student s
join marks m on s.id = m.id group by s.id;




-- -------------------------
-- Stored Procedure: Get Result of One Student
-- -------------------------
DELIMITER //

CREATE PROCEDURE student_result(IN sid INT)
BEGIN
   SELECT s.name, sub.sub_name, m.marks
   FROM student s
   JOIN marks m ON s.id = m.sid
   JOIN subjects sub ON sub.sub_id = m.sub_id
   WHERE s.id = sid;
END //

DELIMITER ;



- -------------------------
-- TRIGGER: Validate Marks Between 0 and 100
-- -------------------------
DELIMITER //

CREATE TRIGGER valid_marks
BEFORE INSERT ON marks
FOR EACH ROW
BEGIN
    IF NEW.marks < 0 OR NEW.marks > 100 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Marks must be between 0 and 100';
    END IF;
END //

DELIMITER ;



















