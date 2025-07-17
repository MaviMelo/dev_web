# Atividade 7 – CRUD com Relacionamento N-N: Médico, Paciente e Consultas

Professor: Alexandre Strapação Guedes Vianna
•

100 pontos
Objetivo: Desenvolver um sistema web completo que implemente um CRUD (Criar, Ler, Atualizar e Deletar) para três entidades: Médico, Paciente e Consulta, modelando corretamente um relacionamento N para N entre Médicos e Pacientes, através da tabela intermediária Consultas.

## Descrição do Sistema
Você deve criar três tabelas no banco de dados:

Médico:  id (chave primária), nome, especialidade
-	Paciente: id (chave primária), nome, data_nascimento, tipo_sanguineo
-	Consulta: (tabela intermediária para o relacionamento N-N): id_medico (chave estrangeira para Médico), id_paciente (chave estrangeira para Paciente), data_hora (tipo timestamp), observações (texto)
-	Chave primária composta: (id_medico, id_paciente, data_hora)

### Requisitos da Atividade
1.	Criar as três tabelas no banco de dados com seus relacionamentos.
2.	Implementar o CRUD completo de todas as entidades.
3.	Funcionalidade para registrar uma consulta
4.	A interface pode ser feita, inicialmente, com HTML puro. (Após o funcionamento completo, a estilização com CSS é bem-vinda.)

### Opcional – Integração com Login
	Você poderá, opcionalmente, incluir um sistema simples de login e controle de acesso. Essa funcionalidade será obrigatória na próxima atividade, então quem quiser se adiantar já pode integrá-la agora.

### Entrega
	Enviar o link do repositório Git com o projeto ou um arquivo .zip contendo todos os arquivos.
	Incluir obrigatoriamente o script SQL de criação das tabelas no banco de dados.

