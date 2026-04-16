#!/bin/bash
# Server Diagnostics Script

echo "=== SERVER DIAGNOSTICS ==="
echo "Date: $(date)"

# Check if Apache/Nginx is running
echo -e "\n--- Web Server Status ---"
if command -v systemctl &> /dev/null; then
    systemctl status apache2 --no-pager 2>/dev/null || systemctl status httpd --no-pager 2>/dev/null || systemctl status nginx --no-pager 2>/dev/null || echo "No web server service found"
fi

# Check PHP-FPM status
echo -e "\n--- PHP-FPM Status ---"
ps aux | grep php-fpm | grep -v grep || echo "PHP-FPM not running"

# Check disk space
echo -e "\n--- Disk Space ---"
df -h

# Check memory
echo -e "\n--- Memory Usage ---"
free -h

# Check CPU load
echo -e "\n--- CPU Load ---"
uptime

# Check Laravel logs
echo -e "\n--- Recent Laravel Errors ---"
cd /home/godeepaf/public_html
if [ -f storage/logs/laravel.log ]; then
    tail -50 storage/logs/laravel.log | grep -E "(ERROR|CRITICAL|ALERT|EMERGENCY|Stack trace)" | tail -20
else
    echo "No laravel.log file found"
fi

# Check PHP errors
echo -e "\n--- PHP Error Log ---"
if [ -f /var/log/php_errors.log ]; then
    tail -20 /var/log/php_errors.log
elif [ -f /var/log/php8.4-fpm.log ]; then
    tail -20 /var/log/php8.4-fpm.log
else
    echo "PHP error log not found"
fi

# Check if port 80/443 is listening
echo -e "\n--- Listening Ports ---"
netstat -tlnp 2>/dev/null | grep -E ":80|:443" || ss -tlnp 2>/dev/null | grep -E ":80|:443" || echo "Cannot check ports"

echo -e "\n=== END DIAGNOSTICS ==="
