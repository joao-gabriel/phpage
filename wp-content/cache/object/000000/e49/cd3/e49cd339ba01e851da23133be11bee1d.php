6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"180";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2015-01-22 10:17:16";s:13:"post_date_gmt";s:19:"2015-01-22 10:17:16";s:12:"post_content";s:1982:"<p>Apesar de ser algo que consta na documentação, este problema não é algo tão incomum de acontecer e pode tomar um tempo precioso do desenvolvimento até que se perceba o detalhe que faz tudo funcionar de acordo com o esperado.</p>
<p>
Na maioria das vezes que queremos uma série de condições no mesmo campo, simplesmente vamos adicionando as condições diretamente ao índice <em>"conditions"</em> do array de opções do método <em>"find"</em> no Cake. <br />
Afinal, é desta forma que normalmente funciona com campos diferentes:
</p>
[php]

$options = array(
  'conditions' =&gt;; array(
    'Model.id != ' =&gt;; 1,
    'Model.id != ' =&gt;; 2,  
    'Model.id != ' =&gt;; 3,  
  )
)

[/php]

<p>E a query executada pelo Cake acaba sendo:</p>

[sql]
SELECT Model.id FROM models as Model WHERE Model.id != 3
[/sql]

<p>Ou seja, o CakePHP ignorou estes filtros e levou em conta apenas o último, o que faz com que apareçam os registros onde Model.id = 1 e Model.id = 2.<br />
E logo estamos na <a href="http://book.cakephp.org/2.0/en/models/retrieving-your-data.html#complex-find-conditions" title="CakePHP - Retrieving Data" target="_blank">documentação</a> olhando para o problema sem conseguir de fato enxergar o que está errado.</p>

<p>O que se deve prestar muita atenção aqui é o seguinte: <strong>Para condições no mesmo campo PRECISAMOS que as condições em campos repetidos venham dentro de um array</strong>.</p>

<p>Note a diferença entre as condições abaixo e a de cima:</p>

[php]

$options = array(
  'conditions' =&gt; array(
    array('Model.id != ' =&gt; 1),
    array('Model.id != ' =&gt; 2),  
    array('Model.id != ' =&gt; 3),  
  )
)

[/php]

<p>Isto é mais fácil de perceber nas condições ligadas pelo operador OR, mas como o AND é o padrão do Cake e não precisamos declará-lo, muitas vezes isso passa desapercebido e lá se vão preciosos minutos debugando algo simples.</p>

EOF";s:10:"post_title";s:50:"CakePHP - Múltiplas condições em um mesmo campo";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:45:"cakephp-multiplas-condicoes-em-um-mesmo-campo";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2015-10-24 16:32:49";s:17:"post_modified_gmt";s:19:"2015-10-24 16:32:49";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:31:"http://www.phpage.com.br/?p=180";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}