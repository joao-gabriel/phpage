6;V<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:2:"65";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-12-13 13:12:42";s:13:"post_date_gmt";s:19:"2014-12-13 13:12:42";s:12:"post_content";s:6900:"<!--:pt--><p>Este é um tópico que, por mais que existam tutoriais, plugins, etc, ainda parece necessário já que falta uma forma "oficial" recomendada pela documentação e tal.</p>


<p>É claro que em programação muitas vezes não existe "certo" ou "errado" e sim diversas formas de se alcançar um mesmo objetivo.</p>
<p>Mas sendo esta uma tarefa tão comum, poderiam se esforçar em&nbsp;incluir algo sobre o assunto de forma mais oficial na própria <a title="Wordpress Codex" href="https://codex.wordpress.org/" target="_blank">Documentação</a> ou no <a title="Wordpress Handbook" href="https://make.wordpress.org/core/handbook/" target="_blank">Handbook</a>. 

Ou quem sabe, adotar um plugin e integrá-lo ao core.</p>

<p>Bem, divagações à parte, vamos à solução que eu utilizei neste blog:</p>


<p>Buscando o melhor entre fatores como agilidade (tempo de entrega), performance, preço (tudo grátis :D) e código limpo e de fácil compreensão cheguei a esta combinação:</p>

<h3>mqTranslate:</h3>
<p><a title="mqTranslate" href="https://wordpress.org/plugins/mqtranslate/" target="_blank">https://wordpress.org/plugins/mqtranslate/</a></p>

<p>Uso apenas para a tradução do conteúdo dinâmico, apesar do plugin oferecer a opção de traduzir frases estáticas do template através de tags especiais, preferi o método de internacionalização padrão do wordpress com os arquivos .po e .mo. </p>
<p>Acredito que seja uma forma de precisar mexer o mínimo possível nos arquivos fonte para qualquer alteração.</p>
<p><small><em>Nota: A escolha do mqTranslate se deu por incompatibilidade do original qTranslate com as novas versões do Wordpress (3.9+), mais informações em: <a href="http://stackoverflow.com/questions/25740231/qtranslate-issue-in-wordpress-4-0" target="_blank">qTranslate issue in WordPress 4.0</a> e <a title="Changeset 29630" href="https://core.trac.wordpress.org/changeset/29630" target="_blank">Changeset 29630</a></em></small></p>
<h3>Codestyling Localization:</h3>

<p><a title="Code Styling" href="http://www.code-styling.de/english" target="_blank">http://www.code-styling.de/english/development/wordpress-plugin-codestyling-localization-en</a></p>

<p>Este é o plugin que uso para traduzir as frases do template diretamente pelo browser.</p>
<p>Ele faz o serviço completo que o POEdit faria:&nbsp;Busca as funções de internacionalização no código fonte do tema, monta a listagem de frases a serem traduzidas e gera o .mo para a tradução.</p>
<p>Além do mais, o&nbsp;slogan "It's not a bug. It's always a feature." é sensacional! ;)</p>

<h3>Customização no&nbsp;tema:</h3>

<p>Além dos plugins, pelo menos quando o assunto é tradução, sempre tem que rolar uma mãozinha na massa no próprio código. 

É nesta parte que mais chove críticas, sugestões, choros, epifanias, e tudo mais...

Provavelmente existem outras milhões de formas de se fazer o que eu fiz, sintam-se livres para comentar.

Decidi por fazer&nbsp;tudo em&nbsp;javascript e pelo próprio wp-admin. 

Segui mais ou menos as instruções sugeridas pelo&nbsp;usuário&nbsp;ElectricFeet <a title="qtranslate - How to add language switcher button in menu bar" href="https://wordpress.org/support/topic/qtranslate-how-to-add-language-switcher-button-in-menu-bar" target="_blank">neste tópico</a>, mas estas soluções sempre levavam o usuário para o HOME do site no idioma selecionado e&nbsp;eu queria que o usuário ficasse na mesma página ao trocar o idioma.

Segue o passo-a-passo das diferenças entre o que ele sugere e o que eu fiz:</p>
<ul>
<li>Criei um menu especialmente para a troca de idiomas e deixei o nome dele&nbsp;como "idiomas".
<li>Nos links dos itens deixei apenas um caracter # (o javascript irá se encarregar de redirecionar o usuário para a página atual traduzida)
<li>No campo "Classes CSS", além das classes para estilizar o item do menu, inseri o <a title="ISO 639: 2-letter codes" href="http://www.w3.org/WAI/ER/IG/ert/iso639.htm#2letter" target="_blank">código iso639&nbsp;de 2 letras</a>&nbsp;do idioma referente ao item ("pt" para português. "en" para inglês).
<li>Na hora de chamar o menu no header.php, incluí a classe "idiomas" no container:
</li></ul>

[php]
$args = array(
  'menu' =&gt;'idiomas',
  'container' =&gt; 'nav',
  'container_class' =&gt; 'blog-nav pull-right idiomas',
  'items_wrap' =&gt; '%3$s'
);
wp_nav_menu($args);
[/php]

<ul>
<li>Por fim desenvolvi o código javascript que trata e redireciona o usuário para a página atual no idioma selecionado no menu:
</li></ul>

[javascript]
// Evento do clique nos itens do menu idiomas
$('.idiomas li a').click(function(e) {

  // Verifica qual idioma foi clicado 
  var langs = ['en', 'pt'];

  for (i = 0; i &lt; langs.length; i++) {

    // Verifica se o item do menu contém uma classe com o nome do idioma sendo avaliado nesta iteração
    if ($(this).parent().hasClass(langs[i])) {

      // Se tiver, este é o idioma selecionado
      var selectedLang = langs[i];
      break;
    }
  }

  // Armazena a URL atual na forma de array, sem o protocolo, na variável url
  var url = window.location.href.replace(window.location.protocol + '//', '').split('/');

  // Se estiver rodando localmente, normalmente 'localhost' será o primeiro elemento da
  // url e o nome do projeto o segundo. Logo, o índice do idioma será o terceiro (2).
  // No ar, normalmente será o segundo (1)
  var langIndex = (window.location.hostname === 'localhost') ? 2 : 1;

  // Altera o valor no índice correspondente ao idioma pelo idioma selecionado
  url[langIndex] = selectedLang;

  // Monta a URL desta mesma página, porém com o idioma alterado
  var redirectUrl = window.location.protocol + '/'
  for (i = 0; i &lt; url.length; i++) {
    redirectUrl += '/' + url[i];
  }

  // Redireciona o usuário
  window.location.href = redirectUrl;

  // Para por aqui
  e.preventDefault();
  return false;
});
[/javascript]


<p><strong>OBS:</strong> 

Esta técnica funciona exatamente como está somente para o Wordpress e o mqTranslate configurados para URLs amigáveis.

Tenho a impressão de que uma otimização poderia ser feita utilizando <a title="JavaScript RegExp Reference" href="http://www.w3schools.com/jsref/jsref_obj_regexp.asp" target="_blank">REGEX</a> para recriar a URL. Isto pode ficar para uma outra versão desse código.

<br />

Outra possibilidade seria fazer este tratamento pelo backend, com PHP, através de um loop com o resultado da função <a href="http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items" title="wp_get_nav_menu_items()" target="_blank">wp_get_nav_menu_items()</a> ou de um "walker" na função <a href="http://codex.wordpress.org/Function_Reference/wp_nav_menu" title="wp_nav_menu()" target="_blank">wp_nav_menu()</a>. Mais um assunto a ser explorado em outro futuro tópico.
</p>

EOF

&nbsp;<!--:-->";s:10:"post_title";s:91:"Traduzindo conteúdo e tema no Wordpress Translating content and theme strings on Wordpress";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:41:"traduzindo-conteudo-e-tema-no-wordpress-4";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2014-12-13 13:12:42";s:17:"post_modified_gmt";s:19:"2014-12-13 13:12:42";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:30:"http://www.phpage.com.br/?p=65";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}