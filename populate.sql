INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('joaoaraujo@gmail.com', 'joaoaraujo76', 'João Araújo', '1234', '934212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('liavieira@gmail.com', 'liavieira02', 'Lia Vieira', '1234', '934772314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('joaomoreira@gmail.com', 'joaomoreira07', 'João Moreira','1234', '944212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('hugogomes@gmail.com', 'hugogomes82', 'Hugo Gomes', '1234', '934211114');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('diogoneves@gmail.com', 'neves76', 'Diogo Neves', '1234', '934212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('tiagoaleixo@gmail.com', 'aleixo02', 'Tiago Aleixo', '1234', '934772314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('diogobabo@gmail.com', 'diogo_babo07', 'Diogo Babo','1234', '944212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('tiagobranquinho@gmail.com', 'branquinho82', 'Tiago Branquinho', '1234', '934211114');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('alexandrecorreia@gmail.com', 'alex_correia76', 'Alexandre Correia', '1234', '934212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('henriquesilva@gmail.com', 'henriquesilva02', 'Henrique Silva', '1234', '934772314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('tiagomartins@gmail.com', 'tiagomartins07', 'Tiago Martins','1234', '944212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('helenacoelho@gmail.com', 'helenacoelho82', 'Helena Coelho', '1234', '934211114');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('zemaciel@gmail.com', 'zemaciel07', 'José Maciel','1234', '944212314');
INSERT INTO authenticated_user (email, username, name, password, phone_number) VALUES ('ruisilveira@gmail.com', 'ruisilveira82', 'Rui Silveira', '1234', '934211114');
INSERT INTO authenticated_user (email, username, name, password, phone_number, administrator) VALUES ('admin@gmail.com', 'admin1', 'admin', '1234', '934211114', True);


INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',1);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',2);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',4);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',5);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',6);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',7);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',8);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/user1.jpeg',9);
INSERT INTO photo (path,id_user) VALUES ('docs/profiles/admin.jpeg',14);


INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de LBAW', 'O intuito do trabalho é desenvolver um site de apoio a workflow de equipas', '2022-10-01', 1);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de PFL', 'O intuito do trabalho é aprender o conceito de programação funcional em haskell', '2022-10-01', 2);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de FSI', 'O intuito do trabalho é aprender os conceito de segurança informática','2022-10-01', 3);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de Redes', 'O intuito do trabalho é desenvolver um protocolo de dados','2022-10-01', 4);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de IPC', 'O intuito do trabalho é perceber e aperfeiçoar o tópico de user interface','2022-10-01', 2);


INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Estrututa base de dados', 'To Do', 'Ter em atenção as tabelas todas restrições, primary keys, coinstrains etc','2022-10-31','High',1,1,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Popular base de dados', 'To Do', 'Pelo menos 5 tuplis por cada tabela','2022-10-31','High',1,1,1);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Main_page', 'To Do', 'Desenvolver a página de entrada do site, adiconar informação sobre o site, contact us etc','2022-10-31','High',1,1,3);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Main_page_design', 'Done', 'A página incial tem de ser chamativa','2022-10-31','High',1,1,4);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Página_projeto', 'To Do', 'Página do projeto, esta página terá de constar os nomes dos participantes bem como as tasks de cada projeto','2022-10-31','High',1,1,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Página_perfil', 'To Do', 'Página do perfil é importante ter uma secção de dados pessoais','2022-10-31','High',1,1,3);

INSERT INTO role (role,id_user,id_project) VALUES ('Coordinator', 1,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',2,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',3,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',4,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',2,2);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',3,3);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',4,4);

INSERT INTO invite (state,date,id_project,id_user_sender,id_user_receiver) VALUES ('Accepted','2022-10-30',2,2,3);
INSERT INTO invite (state,date,id_project,id_user_sender,id_user_receiver) VALUES ('Accepted','2022-10-30',3,3,4);
INSERT INTO invite (state,date,id_project,id_user_sender,id_user_receiver) VALUES ('Received','2022-10-30',4,4,5);
INSERT INTO invite (state,date,id_project,id_user_sender,id_user_receiver) VALUES ('Rejected','2022-10-30',4,4,6);

INSERT INTO comment (comment,date,id_task,id_user) VALUES ('tu és mesmo bom em css','2022-10-30',3,3);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Acrescenta só uma botão de sidebar está perfeito','2022-10-30',3,2);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Bom trabalho Hugo, vais ser promovido','2022-10-30',3,1);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Quando é que isso está pronto? Quero começar a popular a base de dados','2022-10-30',1,1);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Amanha acabo sem falta!','2022-10-30',1,2);

INSERT INTO faq (question,answer) VALUES ('Como Criar uma conta?', 'Na página incial ou em qualquer página se não tiveres ainda com a conta loggada, no canto superior direito, terás a opção de dar login. Clicar nessa opção que te redirecionará para uma página onde te poderás registar.');
INSERT INTO faq (question,answer) VALUES ('Como Apagar a conta ?', 'Na página do teu perfil encontar lá essa oplção');
INSERT INTO faq (question,answer) VALUES ('Posso apagar a conta sendo coordendor do projeto ?', 'Não, caso sejas coordenador de um projeto apenas poderás apagar a tua conta depois de passares esse cargo a alguém da tua equipa');
INSERT INTO faq (question,answer) VALUES ('Fui banido, posso aceder à conta ?', 'A nossa equipa conta com administradores, que terão o poder de banir quálquer usuário que faça comentários negativos, ou ponha em causa a ética do website. Uma vez banidos, deixam de poder aceder às vossas contas.');

INSERT INTO ban (reason,date,id_banned,id_admin) VALUES ('Mau comportamento','2022-10-30',13,15);
INSERT INTO ban (reason,date,id_banned,id_admin) VALUES ('Comentários racistas','2022-10-30',14,15);

INSERT INTO favorite_proj (id_user,id_project) VALUES (1,1);
INSERT INTO favorite_proj (id_user,id_project) VALUES (2,1);
INSERT INTO favorite_proj (id_user,id_project) VALUES (3,1);
INSERT INTO favorite_proj (id_user,id_project) VALUES (4,1);


