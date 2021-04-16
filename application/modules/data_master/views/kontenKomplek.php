<?php
$data=$this->reff->getKomplek($id);
		$result="";
		foreach($data as $data)
		{
			$result.="'".$data->nama."',";
		}
	
?>
		
		<script>
        var data = {
            komplek: [<?php echo $result;?>],
        };
        typeof $.typeahead === 'function' && $.typeahead({
            input: ".js-typeahead",
            minLength: 1,
            order: "asc",
            group: true,
            maxItemPerGroup: 3000,
            groupOrder: function () {

                var scope = this,
                    sortGroup = [];

                for (var i in this.result) {
                    sortGroup.push({
                        group: i,
                        length: this.result[i].length
                    });
                }

                sortGroup.sort(
                    scope.helper.sort(
                        ["length"],
                        false, // false = desc, the most results on top
                        function (a) {
                            return a.toString().toUpperCase()
                        }
                    )
                );

                return $.map(sortGroup, function (val, i) {
                    return val.group
                });
            },
            hint: false,
            dropdownFilter: false,
            template: "{{display}} ",
            emptyTemplate: "",
            source: {
                Pilih: {
                    data: data.komplek
                },
            },
           
            debug: true
        });

    </script>
