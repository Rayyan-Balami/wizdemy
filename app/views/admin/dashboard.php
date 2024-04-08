<?php
View::renderPartial('Header', [
	'pageTitle' => SITE_NAME . ' | Admin Dashboard',
	'stylesheets' => [
		'statusAndZeroResult',
		'adminStyles',
	],
	'scripts' => [
		'script',
		'toastTimer',
		'confirmModal',
	]
]);

View::renderPartial('AdminSideNav', [
	'currentPage' => 'overview'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
	<!-- component
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet"> -->


	<!-- welcome banner  -->
	<div class="welcome-banner">
		<div class="svg-div">
			<?php if (Session::get('admin')['admin_id'] == 1): ?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
					<g fill="currentColor">
						<path fill-rule="evenodd"
							d="m14.896 13.818l1.515-5.766l-2.214 1.41a2 2 0 0 1-2.74-.578L10 6.695l-1.458 2.19a2 2 0 0 1-2.74.577L3.59 8.052l1.515 5.766zm-10.77-6.61c-.767-.489-1.736.218-1.505 1.098l1.516 5.766a1 1 0 0 0 .967.746h9.792a1 1 0 0 0 .967-.746l1.516-5.766c.23-.88-.738-1.586-1.505-1.098l-2.214 1.41a1 1 0 0 1-1.37-.288l-1.458-2.19a1 1 0 0 0-1.664 0L7.71 8.33a1 1 0 0 1-1.37.289z"
							clip-rule="evenodd" />
						<path
							d="M10.944 3.945a.945.945 0 1 1-1.89.002a.945.945 0 0 1 1.89-.002M18.5 5.836a.945.945 0 1 1-1.89.001a.945.945 0 0 1 1.89 0M3.389 5.836a.945.945 0 1 1-1.89.001a.945.945 0 0 1 1.89 0" />
						<path fill-rule="evenodd" d="M5.25 16a.5.5 0 0 1 .5-.5h8.737a.5.5 0 1 1 0 1H5.75a.5.5 0 0 1-.5-.5"
							clip-rule="evenodd" />
					</g>
				</svg>
			<?php else: ?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
					<path fill="currentColor"
						d="M216 122a6 6 0 0 0-5.09 2.82a176.66 176.66 0 0 1-16.69 22.65l-17.87-94a14 14 0 0 0-22.5-8.35l-.1.08l-24.53 20.39a2 2 0 0 1-2.44 0l-24.53-20.43l-.1-.08a14 14 0 0 0-22.5 8.34l-17.88 94.07a178.33 178.33 0 0 1-16.68-22.67A6 6 0 0 0 40 122a38 38 0 0 0 0 76h176a38 38 0 0 0 0-76M91.44 55.65a2 2 0 0 1 3.18-1.22l24.54 20.43l.09.08a13.93 13.93 0 0 0 17.5 0l.09-.08l24.54-20.43a2 2 0 0 1 3.18 1.23L178.69 130H77.31ZM40 186a26 26 0 0 1-3.17-51.81c17.67 27.25 36.7 42.86 52.79 51.81Zm88 0c-.34 0-26.71-.41-56-27.91L75 142h106l3 16.05a115.79 115.79 0 0 1-28.89 20.19C139.38 185.81 128.08 186 128 186m88 0h-49.62c16.09-8.95 35.12-24.56 52.79-51.81A26 26 0 0 1 216 186" />
				</svg>
			<?php endif; ?>
			<span class="admin-type">
				<?= Session::get('admin')['admin_id'] == 1 ? 'boss' : 'junior'; ?>
			</span>
		</div>
		<div class="heading">
			<h3>Welcome To Dashboard</h3>
			<h4>
				<?= Session::get('admin')['username'] ?? "Something went wrong" ?>
			</h4>
			<p>
				<?= Session::get('admin')['email'] ?? "Something went wrong" ?>
			</p>
		</div>
	</div>


	<!-- cards of data  -->
	<div class="card-section">
		<!-- total users  -->
		<div class="admin-card">
			<div>
				<div class="svg-div">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path fill="currentColor" fill-opacity="0.3" d="M3 12a9 9 0 1 1 18 0a9 9 0 0 1-18 0" />
						<circle cx="12" cy="10" r="4" fill="currentColor" />
						<path fill="currentColor" fill-rule="evenodd"
							d="M18.22 18.246c.06.097.041.22-.04.297A8.969 8.969 0 0 1 12 21a8.969 8.969 0 0 1-6.18-2.457a.239.239 0 0 1-.04-.297C6.942 16.318 9.291 15 12 15c2.708 0 5.057 1.318 6.22 3.246"
							clip-rule="evenodd" />
					</svg>
				</div>
				<div class="card-info">
					<p class="type">Users</p>
					<p class="num-data">
						<?= $userCount ?>
					</p>
				</div>
			</div>
			<a href="#" class="view-all-anchor">
				View all
			</a>
		</div>
		<!-- total materials  -->
		<div class="admin-card">
			<div>
				<div class="svg-div user-svg">
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
						<g id="SVGRepo_iconCarrier">
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M3.35791 12.7787C2.74772 13.7201 2.99956 15.0291 3.50323 17.647C3.8658 19.5316 4.04709 20.4738 4.67523 21.0991C4.8382 21.2614 5.02054 21.4052 5.2186 21.5277C5.98195 21.9999 6.99539 21.9999 9.02227 21.9999H15.9777C18.0046 21.9999 19.0181 21.9999 19.7814 21.5277C19.9795 21.4052 20.1618 21.2614 20.3248 21.0991C20.9529 20.4738 21.1342 19.5316 21.4968 17.647C22.0004 15.0291 22.2523 13.7201 21.6421 12.7787C21.4864 12.5384 21.2943 12.321 21.0721 12.1332C20.2011 11.3975 18.7933 11.3975 15.9777 11.3975H9.02227C6.20667 11.3975 4.79888 11.3975 3.92792 12.1332C3.70566 12.321 3.51363 12.5384 3.35791 12.7787ZM9.69518 17.1806C9.69518 16.7814 10.0376 16.4577 10.4601 16.4577H14.5398C14.9622 16.4577 15.3047 16.7814 15.3047 17.1806C15.3047 17.5798 14.9622 17.9035 14.5398 17.9035H10.4601C10.0376 17.9035 9.69518 17.5798 9.69518 17.1806Z"
								fill="currentColor"></path>
							<path opacity="0.3"
								d="M3.5762 12.4846C3.68271 12.3586 3.80034 12.241 3.92792 12.1332C4.79888 11.3975 6.20667 11.3975 9.02227 11.3975H15.9777C18.7933 11.3975 20.2011 11.3975 21.0721 12.1332C21.2 12.2413 21.3179 12.3592 21.4247 12.4857V9.75579C21.4247 8.84687 21.4247 8.09279 21.3394 7.49156C21.2494 6.85704 21.0531 6.29458 20.5839 5.83245C20.5074 5.75707 20.4266 5.68552 20.342 5.61807C19.8302 5.21023 19.2167 5.04345 18.5222 4.96608C17.8531 4.89155 17.0102 4.89157 15.9769 4.89158L15.6242 4.89158C14.6421 4.89158 14.29 4.88587 13.9711 4.80533C13.7837 4.75802 13.604 4.69195 13.4352 4.60878C13.151 4.46867 12.9033 4.25762 12.2077 3.64132L11.7336 3.22128C11.5345 3.04489 11.3987 2.9245 11.2531 2.81755C10.6284 2.35879 9.86779 2.08132 9.07145 2.01534C8.88602 1.99998 8.6968 1.99999 8.41356 2.00002L8.29714 2.00001C7.65647 1.9999 7.23365 1.99983 6.86652 2.0612C5.26167 2.32947 3.96392 3.45143 3.64782 4.93575C3.57591 5.27344 3.57602 5.66035 3.57619 6.21853L3.5762 12.4846Z"
								fill="currentColor"></path>
						</g>
					</svg>
				</div>
				<div class="card-info">
					<p class="type">Materials</p>
					<p class="num-data">
						<?= $materialCount ?>
					</p>
				</div>
			</div>
			<a href="#" class="view-all-anchor">
				View all
			</a>
		</div>
		<!-- total requests  -->
		<div class="admin-card">
			<div>
				<div class="svg-div user-svg">
					<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
						<g id="SVGRepo_iconCarrier">
							<path
								d="M12.9839 22.4946L13.521 21.5879C13.9375 20.8846 14.1458 20.5329 14.4804 20.3384C14.815 20.144 15.2362 20.1367 16.0786 20.1222C17.3224 20.1008 18.1024 20.0247 18.7566 19.7539C19.9704 19.2515 20.9348 18.2878 21.4375 17.0748C21.6226 16.6283 21.7169 16.123 21.7648 15.4515C21.7903 15.0958 21.803 14.9179 21.708 14.7756C21.6131 14.6332 21.4329 14.5728 21.0723 14.452C19.5606 13.9454 16.0584 12.6565 14.1 11.0008C11.8925 9.13444 9.91782 5.3404 9.21118 3.88615C9.0707 3.59705 9.00047 3.4525 8.87715 3.37622C8.75383 3.29994 8.59743 3.30159 8.28463 3.3049C6.25036 3.32638 5.32915 3.43899 4.36537 4.02919C3.69883 4.43737 3.13843 4.9974 2.72997 5.66349C2 6.85388 2 8.47432 2 11.7152V12.7053C2 15.0118 2 16.1651 2.37707 17.0748C2.87984 18.2878 3.84419 19.2515 5.05797 19.7539C5.71215 20.0247 6.49219 20.1008 7.73591 20.1222C8.57837 20.1367 8.9996 20.144 9.33417 20.3384C9.66874 20.5329 9.87702 20.8846 10.2936 21.5879L10.8307 22.4946C11.3094 23.3028 12.5052 23.3028 12.9839 22.4946Z"
								fill="currentColor"></path>
							<path fill-rule="evenodd" clip-rule="evenodd" opacity="0.5"
								d="M14.8719 0.239228C15.2073 0.55542 15.2039 1.06491 14.8643 1.3772L13.7622 2.39066C14.721 2.39968 15.6433 2.42144 16.4756 2.47388C17.1913 2.51898 17.8616 2.5879 18.4457 2.69609C19.0178 2.80206 19.569 2.95641 20.0069 3.20311C20.8206 3.66166 21.5058 4.29141 22.0058 5.04157C22.4867 5.76328 22.6986 6.57904 22.8003 7.56276C22.8998 8.52518 22.8998 9.72792 22.8998 11.253V11.2953C22.8998 11.7397 22.5129 12.1 22.0355 12.1C21.5582 12.1 21.1712 11.7397 21.1712 11.2953C21.1712 9.7186 21.1703 8.59328 21.0797 7.71697C20.9904 6.85308 20.8201 6.31502 20.5369 5.89005C20.1817 5.35695 19.6936 4.90776 19.1118 4.57993C18.9261 4.47529 18.6031 4.36615 18.1084 4.27451C17.6257 4.18509 17.0367 4.12228 16.3589 4.07957C15.5758 4.03023 14.7025 4.00921 13.7763 4.00026L14.8643 5.00068C15.2039 5.31298 15.2073 5.82246 14.8719 6.13865C14.5364 6.45485 13.9892 6.45801 13.6496 6.14572L11.0568 3.76146C10.8923 3.61027 10.7998 3.40409 10.7998 3.18894C10.7998 2.97379 10.8923 2.76761 11.0568 2.61642L13.6496 0.232165C13.9892 -0.0801259 14.5364 -0.0769636 14.8719 0.239228Z"
								fill="currentColor"></path>
						</g>
					</svg>
				</div>
				<div class="card-info">
					<p class="type">Requests</p>
					<p class="num-data">
						<?= $requestCount ?>
					</p>
				</div>
			</div>
			<a href="#" class="view-all-anchor">
				View all
			</a>
		</div>
		<!-- total projects  -->
		<div class="admin-card">
			<div>
				<div class="svg-div user-svg">
					<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
						<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
						<g id="SVGRepo_iconCarrier">
							<title>github [#142]</title>
							<desc>Created with Sketch.</desc>
							<defs> </defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g id="Dribbble-Light-Preview" transform="translate(-140.000000, -7559.000000)" fill="currentColor"
									opacity="0.9">
									<g id="icons" transform="translate(56.000000, 160.000000)">
										<path
											d="M94,7399 C99.523,7399 104,7403.59 104,7409.253 C104,7413.782 101.138,7417.624 97.167,7418.981 C96.66,7419.082 96.48,7418.762 96.48,7418.489 C96.48,7418.151 96.492,7417.047 96.492,7415.675 C96.492,7414.719 96.172,7414.095 95.813,7413.777 C98.04,7413.523 100.38,7412.656 100.38,7408.718 C100.38,7407.598 99.992,7406.684 99.35,7405.966 C99.454,7405.707 99.797,7404.664 99.252,7403.252 C99.252,7403.252 98.414,7402.977 96.505,7404.303 C95.706,7404.076 94.85,7403.962 94,7403.958 C93.15,7403.962 92.295,7404.076 91.497,7404.303 C89.586,7402.977 88.746,7403.252 88.746,7403.252 C88.203,7404.664 88.546,7405.707 88.649,7405.966 C88.01,7406.684 87.619,7407.598 87.619,7408.718 C87.619,7412.646 89.954,7413.526 92.175,7413.785 C91.889,7414.041 91.63,7414.493 91.54,7415.156 C90.97,7415.418 89.522,7415.871 88.63,7414.304 C88.63,7414.304 88.101,7413.319 87.097,7413.247 C87.097,7413.247 86.122,7413.234 87.029,7413.87 C87.029,7413.87 87.684,7414.185 88.139,7415.37 C88.139,7415.37 88.726,7417.2 91.508,7416.58 C91.513,7417.437 91.522,7418.245 91.522,7418.489 C91.522,7418.76 91.338,7419.077 90.839,7418.982 C86.865,7417.627 84,7413.783 84,7409.253 C84,7403.59 88.478,7399 94,7399"
											id="github-[#142]"> </path>
									</g>
								</g>
							</g>
						</g>
					</svg>
				</div>
				<div class="card-info">
					<p class="type">Projects</p>
					<p class="num-data">
						<?= $projectCount ?>
					</p>
				</div>
			</div>
			<a href="#" class="view-all-anchor">
				View all
			</a>
		</div>
	</div>

	<div>
			<canvas id="myChart"></canvas>
		</div>
	<?php
	View::renderPartial(
		'AdminUserListTable'
	);
	?>
</section>

</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const ctx = document.getElementById('myChart').getContext('2d');

		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
				datasets: [
					{
						label: 'Fully Rounded',
						data: [12, 19, 3, 5, 2, 3],
						borderColor: 'red',
						backgroundColor: 'rgba(255, 0, 0, 0.5)',
						borderWidth: 2,
						borderRadius: Number.MAX_VALUE,
						borderSkipped: false,
					},
					{
						label: 'Small Radius',
						data: [2, 3, 20, 5, 1, 4],
						borderColor: 'blue',
						backgroundColor: 'rgba(0, 0, 255, 0.5)',
						borderWidth: 2,
						borderRadius: 5,
						borderSkipped: false,
					}
				]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Chart.js Bar Chart'
					}
				}
			},
		});
	});
</script>

<?php

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
