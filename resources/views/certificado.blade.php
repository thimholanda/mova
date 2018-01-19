<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Certificado</title>
	<link rel="stylesheet" href="">
</head>
<style type="text/css" media="screen">
	*{
		margin: 0;
		padding: 0;
	}
	img{
		display: block;
		position: absolute;
		left: 0;
		top: 0;
		width: 1118px;
	}
	.infos{
		position: absolute;
		/*background-color: red;*/
		top: 260px;
		left: 90px;
		width: 925px;
		font-family: 'arial', sans-serif;
	}

	.infos span{
		font-size: 22px;
	}

	.infos p{
		width: 100%;
		border-bottom: 1px solid black;
		font-size: 22px;
		padding-bottom: 5px;
	}

	.infos p + p{
		margin-top: 35px;
	}

</style>
<body>
	<img src="http://ziitbusiness.com.br/dev/public/material/certificado/bg.jpg" alt="">
	<div class="infos">
		<p><strong>EMPRESA</strong>: {{ mb_strtoupper($nome, 'utf-8') }}</p>
		<p><strong>SITE DA EMPRESA</strong>: {{  mb_strtoupper($site_empresa, 'utf-8') }}</p>
		<p><strong>RECS (Certificados) ALOCADOS PARA O ANO</strong>: {{  mb_strtoupper($recs_alocados, 'utf-8') }} ({{ $recs_alocados * 1000 }} kWh)</p>
		<p><strong>DATA DE EMISSÃO</strong>: {{  mb_strtoupper($data_emissao, 'utf-8') }}</p>
		<p><strong>VALIDADE</strong>: {{  mb_strtoupper($validade, 'utf-8') }}</p>
	</div>
</body>
</html>