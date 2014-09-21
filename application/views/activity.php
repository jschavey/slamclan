<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Clan Activity Report</h1>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>Member</td>
                <td>Last Seen</td>
            </tr>
        </thead>
        <tbody>
            <? foreach( $careers as $career ): ?>
                <tr>
                    <td><?= $career->battleTag ?></td>
                    <td><?= $career->lastSeen->days . ' days and ' . $career->lastSeen->h . ' hours' ?></td>
                </tr>
            <? endforeach ?>        
        </tbody>
    </table>
</div>