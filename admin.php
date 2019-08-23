
<html>
<head>
    <title>Import JSON File</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/admin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/admin/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/admin/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/admin/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/admin/css/main.css">
</head>
<?php 
include 'output/dbConfig.php'; 
require_once('protect.php');
$query = $db->query("SELECT * FROM formular ORDER BY id DESC");
?>
<body>
<div class="limiter">

		<div class="container-table100">
        <button class="btn third generate">
            Generare lista completa
        </button>
        <button class="btn third export">
            <a href="output/exportData.php">Export Pacienti</a>
        </button>
        <button class="btn third import">
            Import Pacienti
        </button>
        <button class="btn third delete_all blocked">
            Sterge toti pacientii
        </button>
			<div class="wrap-table100">
				<div class="table100 ver1">
					<div class="table100-firstcol">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Pacients</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                while($row = $query->fetch_assoc()){ ?>
								<tr class="row100 body">
									<td class="cell100 column1"><?php echo $row['name']; ?></td>
                                </tr>
                                <?php } ?>
							</tbody>
						</table>
					</div>
					
					<div class="wrap-table100-nextcols js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column2">Asigurat</th>
										<th class="cell100 column3">Varsta</th>
										<th class="cell100 column4">Data Nasterii</th>
										<th class="cell100 column5">Consultat</th>
									</tr>
								</thead>
								<tbody>
                                <?php
                                $query = $db->query("SELECT * FROM formular ORDER BY id DESC");
                                    while($row = $query->fetch_assoc()){ ?> 
									<tr class="row100 body">
										<td class="cell100"><?php echo $row['asigurat']; ?></td>
                                        <td class="cell100"><?php echo $row['varsta']; ?></td>
                                        <td class="cell100"><?php echo $row['datanasterii']; ?></td>
                                        <td class="cell100"><?php echo ($row['status'] == 'zzseen')?'Consultat':'Neconsultat'; ?></td>
                                    </tr>
                                    <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<script src="assets/admin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/admin/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/admin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})

			$(this).on('ps-x-reach-start', function(){
				$(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
			});

			$(this).on('ps-scroll-x', function(){
				$(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
			});

		});
        // jQuery(document).on("click", '.export', function (event) {
        //     $.ajax('./output/exportData.php')
        //     .done(function () {
        //         alert('Documentul a fost creat.');
        //     })
        //     .fail(function () {
        //         alert('A aparut o problema la crearea documentului.');
        //     })
        // });

        jQuery(document).on("click", '.import', function (event) {
            $.ajax('./output/importPacients.php')
            .done(function () {
                alert('Datele au fost importate.');
                window.location.reload(true);
            })
            .fail(function () {
                alert('A aparut o problema la crearea documentului.');
            })
        });

        jQuery(document).on("click", '.generate', function (event) {
            $.ajax('excel.php')
            .done(function () {
                alert('Datele au fost concatenate.');
            })
            .fail(function () {
                alert('A aparut o problema la crearea documentului.');
            })
        });

        jQuery(document).on("click", '.delete_all', function (event) {
            if (jQuery(this).hasClass("blocked")) {
                alert("Acum poti sterge toti pacientii")
                return;
            }
            $.ajax('delete_all.php')
            .done(function () {
                alert('Toti pacientii au fost stersi');
            })
            .fail(function () {
                alert('A aparut o problema la stergerea pacientilor.');
            })
        });

        jQuery(document).on("click", '.delete_all', function (event) {
            jQuery(this).removeClass("blocked")
        });
		
		
	</script>
<!--===============================================================================================-->
	<script src="assets/admin/js/main.js"></script>