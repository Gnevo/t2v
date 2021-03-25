<ul>
{foreach $online_employees as $employees}
    <li>
        <a href="javascript:void(0);" onclick="chatWith('{$employees.u_name}');">
            {$employees.emp_name}
        </a>
    </li>
{foreachelse}
    <li> No online employees </li>
{/foreach}
</ul>
