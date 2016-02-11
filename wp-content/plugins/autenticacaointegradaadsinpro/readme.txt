=== Autenticação Integrada AD Sinpro/RS ===
Programador: Lucas Emerim Marques
Referências: http://blog.doh.ms/2008/03/10/desenvolvendo-plugins-para-wordpress/?lang=pt-br
			 http://daviwp.com/como-criar-um-plugin-para-wordpress/
			 http://www.escolawp.com/2012/01/como-criar-plugins-para-wordpress-parte-i/			 

== Resumo ==

		Efetuada a autenticação dos usuários através da página intermediária de validação das credenciais no AD (Active Directory) do Sinpro/RS <autenticaAplicacaoAd.asp>.  	
		Esta página está na intranet do Sinpro/RS, uma vez que a intranet não estiver acessível a autenticação é efetuada diretamente pela base de dados de usuários do
		wordpress. A cada autenticação no AD é atualizado os dados dos usuários na base de dados do wordpress, mantendo assim uma cópia fiel dos dados do usuário no 
		wordpress.

== Descrição ==

Apresentação das principais funcionalidades do plugin:
	1 – Verifica acesso á página de autenticação localizada na intranet do Sinpro < autenticaAplicacaoAd.asp > 
	2 - <Página de autenticação acessível> Autenticam credenciais de acesso (usuário, senha e token)
	3 - <Credenciais OK>Verifica a existência do usuário na base do wordpress.
	4 - <Usuário inexistente> Insere os dados do usuário.
	5 - <Usuário já cadastrado> Atualiza as informações do usuário.
	6 - <Página de autenticação não acessível> Valida credenciais diretamente no wordpress.


== Instalação ==

1. Faça upload dos arquivos para a pasta `/wp-content/plugins/`  (mantenha a pasta original do plugin)
1. Ative o plugin na interface de 'Plugins' do WordPress
1. Na Aba de opções configure o plugin
