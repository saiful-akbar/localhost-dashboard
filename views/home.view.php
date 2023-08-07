<?php

/**
 * Scan directory
 * 
 * @var array
 */
$scan_dir = scandir(dirname(root_dir()));

/**
 * Menambah data php myadmin pada array hasil scan directory.
 */
array_push($scan_dir, 'phpmyadmin');

/**
 * Data array yang akan dihapus.
 * 
 * @var array
 */
$remove = ['.', '..', 'index.php', 'dashboard'];

/**
 * Membersihkan data array hasil scan.
 * 
 * @var array
 */
$directories = array_diff($scan_dir, $remove);

/**
 * Sortir array pada $directories secara asc
 */
asort($directories);

/**
 * Fungsi filter array.
 */
function filter(string $value): bool
{
	$search = strtolower($_GET['search']);
	$value = str_replace('-', ' ', $value);

	return preg_match("/{$search}/i", $value);
}

/**
 * Filter array pada $directories berdasarkan pencarian.
 */
if (!empty($_GET['search'])) {
	$directories = array_filter($directories, "filter");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Dashboard page for localhost initial view.">
	<meta name="base-url" content="<?= url(); ?>">

	<!-- Title -->
	<title>Dashboard - Localhost</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= url('assets/css/bootstrap-icons.css'); ?>">

	<!-- Style -->
	<style>
		table tr th,
		table tr td {
			white-space: nowrap;
		}
	</style>
</head>

<body class="bg-light">
	<script>
		const theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
		const html = document.querySelector('html');

		html.dataset.bsTheme = theme;
	</script>

	<div class="container py-5">
		<h1>Localhost Dashboard</h1>

		<hr class="mb-5">

		<!-- Button reload & form search -->
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-4 col-sm-12 mb-4">
				<button id="btnReload" class="btn btn-primary bg-gradient">
					<i class="bi bi-arrow-clockwise me-1"></i>
					<span>Reload</span>
				</button>
			</div>

			<div class="col-lg-6 col-md-8 col-sm-12 mb-4">
				<form action="<?= url('/'); ?>" autocomplete="off">
					<?php if (isset($_GET['route'])) : ?>
						<input type="hidden" name="route" value="home" />
					<?php endif ?>

					<div class="input-group">
						<input
							type="search"
							name="search"
							value="<?= $_GET['search'] ?? ''; ?>"
							placeholder="Search by application name..."
							class="form-control"
						/>

						<button
							type="submit"
							class="btn btn-secondary bg-gradient"
							data-bs-theme="dark"
						>
							<i class="bi bi-search"></i>
						</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Table -->
		<div class="card shadow-sm">
			<div class="card-body table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Application Name</th>
							<th>URL</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($directories as $directory) : ?>
							<tr>
								<td><?= get_name($directory); ?></td>
								<td>
									<a href="<?= to($directory); ?>" target="_blank">
										<?= to($directory); ?>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="<?= url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

	<!-- Javascript -->
	<script>
		document.querySelector('#btnReload').addEventListener('click', (e) => {
			const url = document.querySelector('meta[name=base-url]').content;
			const params = window.location.search;
			
			window.location.href = url + params;
		});
	</script>
</body>

</html>