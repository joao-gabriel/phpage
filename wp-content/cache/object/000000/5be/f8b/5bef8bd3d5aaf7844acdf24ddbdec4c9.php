6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:2:"59";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-12-14 18:14:41";s:13:"post_date_gmt";s:19:"2014-12-14 18:14:41";s:12:"post_content";s:2199:"<!--:en-->sorry, no english version yet.<!--:--><!--:pt--><p>Quando estamos planejando desenvolver uma atividade, nem sempre o que estipulamos se reflete na prática. 

Ter uma ferramenta que nos diga de verdade quanto tempo levamos em tarefas , por mais corriqueiras que sejam, é indispensável para prever e dimensionar cada vez melhor o tempo destinado a futuros projetos.</p>

<p>Neste post vou expor o Modelo - Entidade - Relacionamento do <a href="http://pt.m.wikipedia.org/wiki/Produto_viável_m%C3%ADnimo" title="Produto Mínimo Viável" target="_blank">PMV</a> do aplicativo e detalhar um pouco cada entidade:</p>

<img class="alignnone size-full wp-image-119" alt="JGNV ERD" src="http://localhost/phpage/wp-content/uploads/2014/12/JGNV-ERD11.png" width="553" height="547" class="alignnone size-full wp-image-119">

<ul>
<li><p><strong>users</strong>:


Armazena informações sobre o usuário e seus dados de login.</p>



<li><p><strong>clients</strong>:

Onde serão armazenados dados dos clientes.</p>



<li><p><strong>projects</strong>:

Dados dos projetos. Pertencem a um cliente e são criados por um user.</p>



<li><p><strong>projects_users</strong>:

Define que usuários terão acesso a que projetos.</p>



<li><p><strong>teams</strong>:

São as equipes, por ex: Desenvolvimento back-end, Web Design, etc.</p>



<li><p><strong>teams_users</strong>:

Agrupa os usuários nas equipes.</p>



<li><p><strong>tasks</strong>:

Dados das tarefas em si, como a data e hora estipulada para o início, a data e hora estipulada para o término, quando realmente começou e terminou a tarefa e quanto tempo levou no total.</p>



<li><p><strong>notes</strong>:

Observações ou informações referentes a uma tarefa.</p>



<li><p><strong>activities</strong>:

Esta entidade armazenará qualquer atividade executada dentro do sistema, sua data e hora, qual usuário executou, a entidade relacionada à atividade e o IP da máquina de onde se originou a atividade. Na versão do PMV serão computadas apenas as atividades: login, logout, início de tarefa e pausa em tarefa. As atividades de pausa e logout são relacionadas com a atividade que as gerou.
</p></li></ul>

EOF

<!--:-->";s:10:"post_title";s:38:"JGNV - Parte 2: ERDJGNV - Parte 2: MER";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:16:"jgnv-parte-2-erd";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2014-12-14 18:14:41";s:17:"post_modified_gmt";s:19:"2014-12-14 18:14:41";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:30:"http://www.phpage.com.br/?p=59";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}