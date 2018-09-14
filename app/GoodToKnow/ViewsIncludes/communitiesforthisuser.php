<?php foreach ($communities_for_this_user as $key => $value): ?>
    <a href="/Home/page/<?php echo $key; ?>"><?php echo $value; ?></a> ↬
<?php endforeach; ?>