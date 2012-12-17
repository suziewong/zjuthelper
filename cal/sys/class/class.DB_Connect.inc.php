<?php
	class DB_Connect {

			protected $db;

			protected function __construct($dbo=NULL)
			{
				if( is_object($dbo))
				{
					$this->db = $dbo;
				}
				else
				{
					// 在 /sys/config/db-cred.inc.php中定义常量
					$dsn = "mysql:host=". DB_HOST . ";dbname=" .DB_NAME;

					//echo $dsn;
					try
					{
						$this->db = new PDO($dsn, DB_USER, DB_PASS);
					}
					catch( Exception $e)
					{
						die( $e->getMessage() );
					}

				}

			}



	}
?>