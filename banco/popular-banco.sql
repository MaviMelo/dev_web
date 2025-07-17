USE sistema_ifpe;

-- Criação de usuários para professores
INSERT INTO usuarios (username, password) VALUES
('alexandre_prof', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('gustavo_prof', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('allan_prof', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2');

-- Criação de professores
INSERT INTO professores (nome, area, usuario_id) VALUES
('Alexandre', 'Desenvolvimento Web', 1),
('Gustavo', 'Engenharia de Software', 2),
('Allan', 'Programação', 3);

-- Criação de turmas
INSERT INTO turmas (disciplina, turno, professor_id) VALUES
('Web 1', 'Manhã', 1),
('Web 2', 'Tarde', 1),
('Lógica de Programação', 'Noite', 3),
('Projeto 1', 'Tarde', 2);

-- Criação de usuários para alunos
INSERT INTO usuarios (username, password) VALUES
('aluno1', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno2', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno3', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno4', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno5', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno6', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno7', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno8', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno9', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno10', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno11', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno12', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno13', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno14', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno15', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno16', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno17', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno18', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno19', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),
('aluno20', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2');

-- Criação de alunos
INSERT INTO alunos (nome, matricula, data_nascimento, email, usuario_id) VALUES
('Aluno 1', '20230001', '2000-01-01', 'aluno1@ifpe.edu.br', 4),
('Aluno 2', '20230002', '2000-02-01', 'aluno2@ifpe.edu.br', 5),
('Aluno 3', '20230003', '2000-03-01', 'aluno3@ifpe.edu.br', 6),
('Aluno 4', '20230004', '2000-04-01', 'aluno4@ifpe.edu.br', 7),
('Aluno 5', '20230005', '2000-05-01', 'aluno5@ifpe.edu.br', 8),
('Aluno 6', '20230006', '2000-06-01', 'aluno6@ifpe.edu.br', 9),
('Aluno 7', '20230007', '2000-07-01', 'aluno7@ifpe.edu.br', 10),
('Aluno 8', '20230008', '2000-08-01', 'aluno8@ifpe.edu.br', 11),
('Aluno 9', '20230009', '2000-09-01', 'aluno9@ifpe.edu.br', 12),
('Aluno 10', '20230010', '2000-10-01', 'aluno10@ifpe.edu.br', 13),
('Aluno 11', '20230011', '2000-11-01', 'aluno11@ifpe.edu.br', 14),
('Aluno 12', '20230012', '2000-12-01', 'aluno12@ifpe.edu.br', 15),
('Aluno 13', '20230013', '2001-01-01', 'aluno13@ifpe.edu.br', 16),
('Aluno 14', '20230014', '2001-02-01', 'aluno14@ifpe.edu.br', 17),
('Aluno 15', '20230015', '2001-03-01', 'aluno15@ifpe.edu.br', 18),
('Aluno 16', '20230016', '2001-04-01', 'aluno16@ifpe.edu.br', 19),
('Aluno 17', '20230017', '2001-05-01', 'aluno17@ifpe.edu.br', 20),
('Aluno 18', '20230018', '2001-06-01', 'aluno18@ifpe.edu.br', 21),
('Aluno 19', '20230019', '2001-07-01', 'aluno19@ifpe.edu.br', 22),
('Aluno 20', '20230020', '2001-08-01', 'aluno20@ifpe.edu.br', 23);

-- Criação de matrículas
INSERT INTO matriculas (aluno_id, turma_id) VALUES
(1, 1), (1, 2), (2, 1), (2, 3), (3, 1),
(4, 2), (5, 2), (6, 2), (7, 3), (8, 3),
(9, 3), (10, 4), (11, 4), (12, 4), (13, 4),
(14, 1), (15, 1), (16, 2), (17, 3), (18, 4),
(19, 4), (20, 1), (20, 2), (20, 3);
