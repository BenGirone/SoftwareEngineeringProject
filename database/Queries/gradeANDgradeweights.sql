SELECT gradegiven.grade_given, assignments.grade_weight
FROM gradegiven INNER JOIN assignments ON gradegiven.a_id = assignments.a_id
WHERE u_id = 1 AND c_id = 2;