<?php
	require_once("../../database.php");
	require_once("../../models/posts.php");

	$link = db_connect();
    $post_id = $_POST['id'];

	$file = @$_FILES['file'];
	$error = $success = '';
	$last_post_id = $last_post['id'];
	$allow = array('.jpg', '.jpeg', '.png');
	$path = '../../img/';

	if (!empty($file)) {
		if (!empty($file['error']) || empty($file['tmp_name'])) {
				$error = 'Error to upload file';
		} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
			$error = 'File was not uploaded';
		} else {
			$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
			$name = mb_eregi_replace($pattern, '-', $file['name']);
			$name = mb_ereg_replace('[-]+', '-', $name);
			$rand_name = mt_rand(0, 100000);

			$parts = pathinfo($name);
			$name = $rand_name  . "." . $parts['extension'];

			set_image_name($link, $post_id, $name);

			if (empty($name) || empty($parts['extension'])) {
				$error = 'File was not uploaded';
			} elseif (!empty($allow) && !in_array(strtolower("." . $parts['extension']), $allow)) {
				$error = 'Invalid file type';
			} else {
				if (move_uploaded_file($file['tmp_name'], $path . $name)) {
					$success = 'File «' . $name . '» loaded successfully';
				} else {
					$error = 'File was not uploaded';
				}
			}
		}
	
		if (!empty($success)) {
			echo $post_id;		
		} else {
			echo $error;
		}
	} else {
		echo $post_id;
	}

