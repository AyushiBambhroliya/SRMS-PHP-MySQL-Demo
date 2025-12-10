USE student_result;

-- -------------------------
-- Insert Students
-- -------------------------
INSERT INTO student(name, age, city)
VALUES
('Ayushi', 19, 'Surat'),
('Ansh', 20, 'Vadodara'),
('Raj', 21, 'Ahmedabad'),
('Amil', 20, 'Delhi');

-- -------------------------
-- Insert Subjects
-- -------------------------
INSERT INTO subjects(sub_name)
VALUES ('Python'), ('SQL'), ('DSA');

-- -------------------------
-- Insert Marks
-- -------------------------
INSERT INTO marks(sid, sub_id, marks)
VALUES
(1, 1, 90),
(1, 2, 85),
(1, 3, 88),

(2, 1, 70),
(2, 2, 60),
(2, 3, 65),

(3, 1, 92),
(3, 2, 91),
(3, 3, 94),

(4, 1, 80),
(4, 2, 75),
(4, 3, 82);

-- -------------------------
-- Insert Fees
-- -------------------------
INSERT INTO fees(sid, amount, status)
VALUES 
(1, 5000, 'paid'),
(2, 4000, 'pending'),
(3, 4500, 'paid'),
(4, 3500, 'pending');
