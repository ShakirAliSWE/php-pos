<?php
global $objFormFields;
?>
</div>
<div style="clear:both"><br/></div>
    <footer class = "border-top">
        <div>
            <a class = "custom-link-tag text-muted" href = "../">© <?php echo date("Y")." ".COMPANY_NAME;?></a> -
            <a class = "custom-link-tag text-muted" href = "">Shakir Ali</a>
        </div>
    </footer>
</div>
</body>
</html>

<?php
global $objDatabase;
$objDatabase->dbClose();
?>