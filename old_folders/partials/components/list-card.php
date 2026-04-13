<?php if (isset($title, $tableId, $headers, $data, $columns)) : ?>
    <?php 
        $titleColor = $index % 2 === 0 ? "title-purple" : "title-purple"; ?>

    <div class="list-card">
    
        <h3 class="<?= $titleColor ?>"><?= htmlspecialchars($title) ?></h3>
        <table id="<?= htmlspecialchars($tableId) ?>">
            <thead>
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <th><?= htmlspecialchars($header) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)) : ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td>
                                    <?php
                                    // Custom format for known fields
                                    if ($column === 'gender') {
                                        echo htmlspecialchars(formatGender($row[$column]));
                                    } elseif ($column === 'total_points') {
                                        echo htmlspecialchars(formatHoursFromPoints($row[$column]));
                                    } elseif ($column === 'created_at' || $column === 'claim_date') {
                                        echo htmlspecialchars(formatShorterDate($row[$column] ?? ''));
                                    } elseif ($column === 'admin_username') {
                                        echo htmlspecialchars(formatAdmin($row[$column] ?? ''));
                                    } else {
                                        echo htmlspecialchars($row[$column]);
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="<?= count($columns) ?>">No data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
