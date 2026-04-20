backup:
	docker exec -i worklog-mysql-1 sh -c 'mysqldump --no-tablespaces -u workLog_user -p"workLog_pass" workLog_db' > backup_$$(date +%Y-%m-%d).sql

restore:
	docker exec -i worklog-mysql-1 sh -c 'mysql -u workLog_user -p"workLog_pass" workLog_db' < $(file)