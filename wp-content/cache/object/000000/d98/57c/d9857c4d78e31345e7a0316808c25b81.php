6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"189";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2015-01-27 09:32:46";s:13:"post_date_gmt";s:19:"2015-01-27 09:32:46";s:12:"post_content";s:5597:"<!--:pt-->Obter o tempo levado para se executar uma atividade é praticamente a parte mais importante de um sistema de gerenciamento.

Vamos levar em conta os conceitos de <a href="http://www.devmedia.com.br/entendendo-coesao-e-acoplamento/18538" title="Acoplamento e Coesão" target="_blank">acoplamento e coesão</a> para deixar portas abertas a possíveis modificações e adições ao sistema. 

No caso do <a href="https://github.com/joao-gabriel/JGNV" title="JGNV - Github" target="_blank">JGNV</a> não deixamos esta parte fortemente ligada às tarefas (Tasks) em si, pois em algum momento pode ser interessante mensurar outras atividades, como quanto tempo um usuário permaneceu logado ao sistema, por exemplo.

Sendo assim, vamos recorrer ao modelo de Activity para este fim. (que guarda qualquer atividade relacionada com qualquer model desejado) 

Como cada registro grava uma atividade em si, tanto de início quanto fim, nossa consulta não será tão simples quanto a diferença entre dois campos de um mesmo registro no banco, mas graças a algumas funções do MySQL e à possibilidade de fazermos uma JOIN de uma tabela com ela mesma, não será também nada muito complicado.

As funções do MySQL que iremos utilizar são as seguintes:

<ul>
	<li><a href="http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_timediff" title="timediff()" target="_blank">timediff()</a>: Retorna a diferença entre duas datas.</li>


	<li><a href="http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_time-to-sec" title="time_to_sec()" target="_blank">time_to_sec()</a>: Converte a data no formato MySQL para segundos.</li>


	<li><a href="http://www.w3schools.com/sql/sql_func_sum.asp" title="sum()" target="_blank">sum()</a>: Retorna a soma dos valores numéricos na coluna especificada de todos os registros encontradas.</li>


	<li><a href="http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_sec-to-time" title="sec_to_time()" target="_blank">sec_to_time()</a>: Converte o número de segundos informado para data no formato MySQL</li>
</ul>



Com estas quatro funções podemos medir a diferença de tempo entre uma atividade e outra com a seguinte query:

[sql]
SELECT sec_to_time(sum(time_to_sec(timediff(StopActivity.created, Activity.created)))) as timeElapsed FROM `jgnv`.`activities` AS `Activity` INNER JOIN `jgnv`.`activities` AS `StopActivity` ON (`StopActivity`.`parent_id` = `Activity`.`id` AND `StopActivity`.`type` = 2) WHERE `Activity`.`model` = 'Task' AND `Activity`.`model_id` = 2 AND `Activity`.`type` = 1 LIMIT 1
[/sql]

E uma vantagem é que esta query já nos retorna o tempo num formato legível: 01:14:43, por exemplo.

Precisamos apenas "traduzir" esta query para o CakePHP.
Para isso vamos criar o seguinte método no model Activity:

[php]
    /**
   * calcActivityTime method
   *
   * @param int $model
   * @param int $modelId
   * @param int $startType
   * @param int $stopType
   *
   * @return string
   */
  public function calcActivityTime($model, $modelId, $startType, $stopType)  {
     
    $options = array(
        'conditions' =&gt; array(
            'Activity.model' =&gt; $model,
            'Activity.model_id' =&gt; $modelId,
            'Activity.type' =&gt; $startType
        ),
        'joins' =&gt; array(
            array(
                'table' =&gt; 'activities',
                'alias' =&gt; 'StopActivity',
                'type' =&gt; 'INNER',
                'conditions' =&gt; array(
                    'StopActivity.parent_id = Activity.id',
                    'StopActivity.type' =&gt; $stopType
                )
            )
        ),
        'fields' =&gt; array(
            'sec_to_time(sum(time_to_sec(timediff(StopActivity.created, Activity.created)))) as timeElapsed'
        )
    );
    $this-&gt;recursive = -1;
    $total = $this-&gt;find('first', $options);
    
    return $total[0]['timeElapsed'];
    
  }
[/php]

Este método recebe como parâmetros:
<ul>
	<li>O nome do model que desejamos medir</li>
	<li>O id do model selecionado no parâmetro anterior, ao qual as atividades pertencem</li>
	<li>O tipo de início da atividade (uma constante numérica definida no código que representa o tipo da atividade)</li>
	<li>O tipo de fim da atividade (da mesma forma que o parâmetro anterior)</li>
</ul>

Agora, para o caso de calcularmos o tempo gasto até a última pausa numa tarefa, devemos apenas chamar este método passando os parâmetros adequados. Para isso, basta criar um método intermediário em Task que faça a chamada correta referente a uma tarefa específica:

[php]
   /**
   * calcTaskTime method
   * @param int $taskId
   * @return string
   */
  public function calcTaskTime($taskId){
    return $this-&gt;Activity-&gt;calcActivityTime($this-&gt;alias, $taskId, _ACTIVITY_TYPE_START_TASK, _ACTIVITY_TYPE_STOP_TASK);
  }

[/php]

Agora é só o TasksController chamar este método no formato
[php]
$tempo = $this-&gt;Task-&gt;calcTaskTime($id);
[/php]
e a variável $tempo terá a string formatada de quanto tempo a tarefa foi trabalhada até a última vez que foi pausada.

Lembrando que o código do projeto (ainda em fase inicial de desenvolvimento do PMV) encontra-se em 
<a href="https://github.com/joao-gabriel/JGNV" title="Github - JGNV" target="_blank">https://github.com/joao-gabriel/JGNV</a>

Mais para frente vou incluir também o tempo atual se o usuário estiver trabalhando na tarefa no momento ao invés do total até a última pausa, o que dará um resultado mais dinâmico e exato.

EOF<!--:-->";s:10:"post_title";s:39:"Calculando tempo total de uma atividade";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:51:"calculando-tempo-total-de-execucao-de-uma-atividade";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2015-01-27 09:32:46";s:17:"post_modified_gmt";s:19:"2015-01-27 09:32:46";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:31:"http://www.phpage.com.br/?p=189";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}