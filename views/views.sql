



CREATE VIEW STUDENT_VIEW AS
SELECT Sfull_name, Sid, Sschool, Sgrade_level, USER.Ufull_name AS Tname
FROM STUDENT, USER
WHERE STUDENT.Uemail = USER.Uemail;

CREATE VIEW PROJECT_VIEW AS
SELECT Ptitle, Pdescription, Pyear, Pcategory, Sfull_name AS student_name, AVG(Rtotal_score) AS average_score
FROM PROJECT, RUBRIC, STUDENT
WHERE PROJECT.Pid = RUBRIC.Pid AND STUDENT.Sid = PROJECT.Sid GROUP BY RUBRIC.Pid;
