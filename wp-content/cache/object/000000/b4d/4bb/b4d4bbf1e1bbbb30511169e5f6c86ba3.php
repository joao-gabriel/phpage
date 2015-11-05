Ñ6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:222;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2015-10-24 16:36:36";s:13:"post_date_gmt";s:19:"2015-10-24 16:36:36";s:12:"post_content";s:1623:"

Even though this is something "explained"  in the documentation, it is not rare to waste some valuable minutes struggling with the code until one can discover what is going wrong.

Most of the time we want more than one condition on the same field, we just keep adding these conditions as "key" => "value" to the "conditions" index in the options array of our model find() method.

After all, thats the way it usually works with different fields.

[php]

$options = array(
  'conditions' =&gt;; array(
    'Model.id != ' =&gt;; 1,
    'Model.id != ' =&gt;; 2,  
    'Model.id != ' =&gt;; 3,  
  )
)

[/php]


And the resulting query output by CakePHP shows as follow:

[sql]
SELECT Model.id FROM models as Model WHERE Model.id != 3
[/sql]


That is, Cake has ignored the first filters taking only the last one to the SQL query, what makes records where Model.id = 1 and Model.id = 2 to be retrieved.

Soon we'll be at the documentation, staring at the problem without seeing it.

What we have to pay attention here is: For conditions on the same field we have to put them inside arrays.

Note the difference between this conditions and the above ones:

[php]

$options = array(
  'conditions' =&gt; array(
    array('Model.id != ' =&gt; 1),
    array('Model.id != ' =&gt; 2),  
    array('Model.id != ' =&gt; 3),  
  )
)

[/php]

This is easier to perceive when working with the OR operartor, but since AND is the CakePHP default and therefore we don't need to declare it, sometimes it is common to overlook this and waste several minutes debbuging something simple.

EOF";s:10:"post_title";s:43:"CakePHP - Multiple conditions on same field";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:41:"cakephp-multiple-conditions-on-same-field";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2015-10-24 16:36:36";s:17:"post_modified_gmt";s:19:"2015-10-24 16:36:36";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:30:"http://localhost/phpage/?p=222";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}