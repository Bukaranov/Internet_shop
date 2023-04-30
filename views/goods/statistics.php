<table>
    <tr>
        <th>Категория</th>
        <th>Продукт</th>
        <th>Цена</th>
    </tr>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['category_name'] ?></td>
            <td><?= $cat['name'] ?></td>
            <td><?= $cat['price'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<table>
    <tr>
        <th>Бренд</th>
        <th>Продукт</th>
        <th>Цена</th>
    </tr>
    <?php foreach ($brand as $br): ?>
        <tr>
            <td><?= $br['brand_name'] ?></td>
            <td><?= $br['name'] ?></td>
            <td><?= $br['price'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>