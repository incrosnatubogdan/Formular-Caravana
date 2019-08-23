
<html>
<head>
    <title>Import JSON File</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Members list
            <a href="exportData.php" class="btn btn-success pull-right">Export Pacienti</a>
            <a href="importPacients.php" class="btn btn-success pull-right">Import Pacienti</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status Asigurat</th>
                      <th>Varsta</th>
                      <th>Created</th>
                      <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //include database configuration file
                    include 'dbConfig.php';
                    
                    //get records from database
                    $query = $db->query("SELECT * FROM formular ORDER BY id DESC");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){ ?>                
                    <tr>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['asigurat']; ?></td>
                      <td><?php echo $row['varsta']; ?></td>
                      <td><?php echo $row['datanasterii']; ?></td>
                      <td><?php echo ($row['status'] == 'zzseen')?'Consultat':'Neconsultat'; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>