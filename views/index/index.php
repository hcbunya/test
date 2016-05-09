<?php if (!empty($data)){ ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <td>Дата</td>
            <td>Хозяева</td>
            <td>Гости</td>
            <td>Идентификатор стадиона</td>
        </tr>
        </thead>
        <?php foreach ($data as $game) { ?>
        <tr>
            <td><?php echo $game['game_date'] ?></td>
            <td><?php echo $game['team_home'] ?></td>
            <td><?php echo $game['away_team'] ?></td>
            <td><?php echo $game['stadium_id'] ?></td>
        </tr>
        <?php }?>
    </table>
<?php } ?>