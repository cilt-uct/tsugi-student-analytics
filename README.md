# tsugi-student-analytics

## Configuration
1. Copy `cp tool-config-dist.php tool-config.php`
2. Update the details of `tool-config.php` to connect to the REST API

Set `real_weeks` to `true` to use actual week numbers
[ Default: false - Count from 1 upwards ]

#### Enable Downloads for project / course site without provider information

Add the following to custom properties for the LTI tool:
```
real_week_no=true/false  [Default: true - Use actual week numbers, not counting from 1 upwards]
site=[SITE ID]           [Default: empty - Overwrite the default Site with this site id]
```
