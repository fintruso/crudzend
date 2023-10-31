-- public.veiculo definition

-- Drop table

-- DROP TABLE public.veiculo;

CREATE TABLE public.veiculo (
	id serial4 NOT NULL,
	placa varchar(7) NOT NULL,
	renavam varchar(30) NULL,
	modelo varchar(20) NOT NULL,
	marca varchar(20) NOT NULL,
	ano int4 NOT NULL,
	cor varchar(20) NOT NULL,
	CONSTRAINT veiculo_pkey PRIMARY KEY (id)
);


-- public.motorista definition

-- Drop table

-- DROP TABLE public.motorista;

CREATE TABLE public.motorista (
	id serial4 NOT NULL,
	nome varchar(200) NOT NULL,
	rg varchar(20) NOT NULL,
	cpf varchar(11) NOT NULL,
	telefone varchar(20) NULL,
	veiculo_id int4 NULL,
	CONSTRAINT motorista_pkey PRIMARY KEY (id),
	CONSTRAINT motorista_veiculo_id_fkey FOREIGN KEY (veiculo_id) REFERENCES public.veiculo(id)
);