<?php
$links = [
    ['url' => '/dashboard', 'label' => 'Dashboard'],
    ['url' => '/table1', 'label' => 'Table 1'],
    ['url' => '/table2', 'label' => 'Table 2'],
];
?>

<ul>
    <?php foreach ($links as $link): ?>
        <li><a href="<?php echo $link['url']; ?>"><?php echo $link['label']; ?></a></li>
    <?php endforeach; ?>
</ul>

<style>
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin: 5px 0;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
