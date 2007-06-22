<?php

include("common.php");

$website = new love4web();
$db = Persistent::getInstance();

// Store di alcune news
/*
$news_1 = new news("Obscure.Explanations", "<p>Sollicitudin et, arcu. Vivamus viverra. Nullam turpis. Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor. Nullam turpis. Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor.</p>
<p>Sollicitudin et, arcu. Vivamus viverra. Nullam turpis. Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor. Nullam turpis. Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor.</p>", "Luke", "Stile Libero");

$news_2 = new news("Tincidunt.Sed.Vestibulum", "<p>Quisque suscipit, quam vel aliquet tincidunt, eros nisi ultrices urna,
        a interdum est purus vitae leo. Pellentesque a lectus et tortor tincidunt
        dignissim etiam. Aliquam erat volutpat. Quisque risus nunc, eleifend gravida, ullamcorper non, gravida ut, nulla.</p>", "Luke", "Stile Libero");

$db->store($news_1);
$db->store($news_2);
*/

$news = $db->collect("news", 0, 2);
$website->addTemplate("index.tpl");
$website->templateAssign("news", $news);
$website->run();

?>