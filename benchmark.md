PhpBench 0.15-dev (@git_version@). Running benchmarks.
Using configuration file: bench_lib.json

Benchmark string libs
---------------------

### benchmark: AppendAndPrependBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_insert_Str | 374.000μs | 1,892,440b | 1.00x
bench_ensure_left_Str | 377.000μs | 1,892,440b | 1.01x
bench_append_Str | 378.000μs | 1,892,440b | 1.01x
bench_remove_right_Str | 382.000μs | 1,892,440b | 1.02x
bench_ensure_right_Str | 388.000μs | 1,892,440b | 1.04x
bench_prepend_Str | 399.000μs | 1,892,440b | 1.07x
bench_surround_Str | 407.000μs | 1,892,440b | 1.09x
bench_remove_left_Str | 443.000μs | 1,892,440b | 1.18x
bench_remove_right_Stringy | 904.000μs | 2,150,880b | 2.42x
bench_insert_Stringy | 913.000μs | 2,150,872b | 2.44x
bench_remove_left_Stringy | 919.000μs | 2,150,880b | 2.46x
bench_ensure_right_Stringy | 932.000μs | 2,150,880b | 2.49x
bench_surround_Stringy | 937.000μs | 2,150,872b | 2.51x
bench_prepend_Stringy | 952.000μs | 2,150,872b | 2.55x
bench_append_Stringy | 956.000μs | 2,150,872b | 2.56x
bench_ensure_left_Stringy | 995.000μs | 2,150,880b | 2.66x

### benchmark: ArrayBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_chars_Str | 385.000μs | 1,892,392b | 1.00x
bench_lines_Str | 400.000μs | 1,892,392b | 1.04x
bench_split_Str | 404.000μs | 1,892,392b | 1.05x
bench_chars_Stringy | 943.000μs | 2,145,384b | 2.45x
bench_split_Stringy | 988.000μs | 2,145,384b | 2.57x
bench_lines_Stringy | 1,021.000μs | 2,145,384b | 2.65x

### benchmark: BooleansBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_is_hexadecimal_Str | 390.000μs | 1,892,432b | 1.00x
bench_is_serialized_Str | 396.000μs | 1,892,416b | 1.02x
bench_is_json_Str | 400.000μs | 1,892,416b | 1.03x
bench_is_alpha_Str | 402.000μs | 1,892,416b | 1.03x
bench_is_blank_Str | 416.000μs | 1,892,416b | 1.07x
bench_is_base64_Str | 445.000μs | 1,892,416b | 1.14x
bench_is_alpha_numeric_Str | 584.000μs | 1,892,432b | 1.50x
bench_is_base64_Stringy | 920.000μs | 2,149,152b | 2.36x
bench_is_json_Stringy | 936.000μs | 2,149,152b | 2.40x
bench_is_serialized_Stringy | 954.000μs | 2,149,160b | 2.45x
bench_is_blank_Stringy | 956.000μs | 2,149,152b | 2.45x
bench_is_alpha_numeric_Stringy | 958.000μs | 2,149,160b | 2.46x
bench_is_hexadecimal_Stringy | 1,025.000μs | 2,149,160b | 2.63x
bench_is_alpha_Stringy | 1,086.000μs | 2,149,152b | 2.78x

### benchmark: CaseQuestionsBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_has_upper_case_Str | 396.000μs | 1,892,448b | 1.00x
bench_is_lower_case_Str | 397.000μs | 1,892,432b | 1.00x
bench_has_lower_case_Str | 399.000μs | 1,892,448b | 1.01x
bench_is_upper_case_Str | 409.000μs | 1,892,432b | 1.03x
bench_has_upper_case_Stringy | 925.000μs | 2,146,456b | 2.34x
bench_has_lower_case_Stringy | 926.000μs | 2,146,456b | 2.34x
bench_is_lower_case_Stringy | 995.000μs | 2,146,456b | 2.51x
bench_is_upper_case_Stringy | 1,001.000μs | 2,146,456b | 2.53x

### benchmark: CaseTogglingBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_to_title_case_Str | 384.000μs | 1,892,432b | 1.00x
bench_lower_case_first_Str | 395.000μs | 1,892,448b | 1.03x
bench_to_lower_case_Str | 407.000μs | 1,892,432b | 1.06x
bench_upper_case_first_Str | 416.000μs | 1,892,448b | 1.08x
bench_to_upper_case_Str | 416.000μs | 1,892,432b | 1.08x
bench_camelize_Str | 484.000μs | 1,892,432b | 1.26x
bench_upper_camelize_Str | 489.000μs | 1,892,448b | 1.27x
bench_titleize_Str | 494.000μs | 1,892,432b | 1.29x
bench_to_title_case_Stringy | 907.000μs | 2,151,688b | 2.36x
bench_to_lower_case_Stringy | 913.000μs | 2,151,688b | 2.38x
bench_upper_case_first_Stringy | 928.000μs | 2,151,688b | 2.42x
bench_lower_case_first_Stringy | 930.000μs | 2,151,688b | 2.42x
bench_to_upper_case_Stringy | 951.000μs | 2,151,688b | 2.48x
bench_swap_case_Str | 967.000μs | 1,892,432b | 2.52x
bench_swap_case_Stringy | 989.000μs | 2,151,680b | 2.58x
bench_upper_camelize_Stringy | 1,024.000μs | 2,151,688b | 2.67x
bench_titleize_Stringy | 1,032.000μs | 2,151,680b | 2.69x
bench_camelize_Stringy | 1,098.000μs | 2,151,680b | 2.86x

### benchmark: ContainsBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_any_Str | 379.000μs | 1,892,400b | 1.00x
bench_contains_Str | 384.000μs | 1,892,416b | 1.01x
bench_all_Str | 455.000μs | 1,892,400b | 1.20x
bench_any_Stringy | 933.000μs | 2,147,616b | 2.46x
bench_contains_Stringy | 934.000μs | 2,147,616b | 2.46x
bench_all_Stringy | 942.000μs | 2,147,616b | 2.49x

### benchmark: CountAndLengthBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_indexOf_Str | 378.000μs | 1,892,432b | 1.00x
bench_count_Str | 403.000μs | 1,892,416b | 1.07x
bench_length_Str | 417.000μs | 1,892,432b | 1.10x
bench_indexOfLast_Str | 451.000μs | 1,892,432b | 1.19x
bench_length_Stringy | 911.000μs | 2,146,728b | 2.41x
bench_count_Stringy | 925.000μs | 2,146,728b | 2.45x
bench_indexOf_Stringy | 1,011.000μs | 2,146,728b | 2.67x
bench_indexOfLast_Stringy | 1,057.000μs | 2,146,736b | 2.80x

### benchmark: GetBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_last_Str | 378.000μs | 1,892,392b | 1.00x
bench_first_Str | 379.000μs | 1,892,392b | 1.00x
bench_last_Stringy | 920.000μs | 2,146,088b | 2.43x
bench_first_Stringy | 964.000μs | 2,146,088b | 2.55x

### benchmark: HTMLRelatedBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_html_encode_Str | 399.000μs | 1,892,432b | 1.00x
bench_html_decode_Str | 434.000μs | 1,892,432b | 1.09x
bench_html_encode_Stringy | 966.000μs | 2,144,744b | 2.42x
bench_html_decode_Stringy | 972.000μs | 2,144,744b | 2.44x

### benchmark: PadBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_pad_left_Str | 375.000μs | 1,892,408b | 1.00x
bench_pad_both_Str | 398.000μs | 1,892,408b | 1.06x
bench_pad_right_Str | 436.000μs | 1,892,408b | 1.16x
bench_pad_right_Stringy | 907.000μs | 2,145,808b | 2.42x
bench_pad_left_Stringy | 951.000μs | 2,145,808b | 2.54x
bench_pad_both_Stringy | 1,032.000μs | 2,145,808b | 2.75x

### benchmark: ReplaceBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_replace_Str | 409.000μs | 1,892,408b | 1.00x
bench_regex_replace_Str | 450.000μs | 1,892,408b | 1.10x
bench_regex_replace_Stringy | 997.000μs | 2,145,176b | 2.44x
bench_replace_Stringy | 1,018.000μs | 2,145,168b | 2.49x

### benchmark: StringMutatorsBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_reverse_Str | 386.000μs | 1,892,432b | 1.00x
bench_safe_truncate_Str | 389.000μs | 1,892,432b | 1.01x
bench_shuffle_Str | 389.000μs | 1,892,432b | 1.01x
bench_truncate_Str | 398.000μs | 1,892,432b | 1.03x
bench_repeat_Str | 404.000μs | 1,892,432b | 1.05x
bench_humanize_Str | 421.000μs | 1,892,432b | 1.09x
bench_delimit_Str | 423.000μs | 1,892,432b | 1.10x
bench_dasherize_Str | 427.000μs | 1,892,432b | 1.11x
bench_underscored_Str | 431.000μs | 1,892,432b | 1.12x
bench_tidy_Str | 450.000μs | 1,892,416b | 1.17x
bench_to_ascii_Str | 713.000μs | 1,892,432b | 1.85x
bench_slugify_Str | 788.000μs | 1,892,432b | 2.04x
bench_safe_truncate_Stringy | 926.000μs | 2,154,480b | 2.40x
bench_reverse_Stringy | 931.000μs | 2,154,472b | 2.41x
bench_shuffle_Stringy | 961.000μs | 2,154,472b | 2.49x
bench_dasherize_Stringy | 972.000μs | 2,154,472b | 2.52x
bench_delimit_Stringy | 978.000μs | 2,154,472b | 2.53x
bench_underscored_Stringy | 993.000μs | 2,154,480b | 2.57x
bench_repeat_Stringy | 1,003.000μs | 2,154,472b | 2.60x
bench_humanize_Stringy | 1,011.000μs | 2,154,472b | 2.62x
bench_to_ascii_Stringy | 1,024.000μs | 2,154,472b | 2.65x
bench_tidy_Stringy | 1,092.000μs | 2,154,472b | 2.83x
bench_slugify_Stringy | 1,132.000μs | 2,154,472b | 2.93x
bench_truncate_Stringy | 1,206.000μs | 2,154,472b | 3.12x

### benchmark: SubstrBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_at_Str | 373.000μs | 1,892,392b | 1.00x
bench_between_Str | 375.000μs | 1,892,408b | 1.01x
bench_substr_Str | 377.000μs | 1,892,408b | 1.01x
bench_first_Str | 378.000μs | 1,892,392b | 1.01x
bench_last_Str | 381.000μs | 1,892,392b | 1.02x
bench_longest_common_prefix_Str | 423.000μs | 1,892,424b | 1.13x
bench_longest_common_substring_Str | 431.000μs | 1,892,440b | 1.16x
bench_slice_Str | 464.000μs | 1,892,392b | 1.24x
bench_longest_common_suffix_Str | 514.000μs | 1,892,424b | 1.38x
bench_first_Stringy | 906.000μs | 2,152,304b | 2.43x
bench_longest_common_suffix_Stringy | 909.000μs | 2,152,320b | 2.44x
bench_longest_common_prefix_Stringy | 909.000μs | 2,152,320b | 2.44x
bench_last_Stringy | 918.000μs | 2,152,304b | 2.46x
bench_substr_Stringy | 924.000μs | 2,152,304b | 2.48x
bench_slice_Stringy | 942.000μs | 2,152,304b | 2.53x
bench_at_Stringy | 977.000μs | 2,152,304b | 2.62x
bench_between_Stringy | 1,013.000μs | 2,152,304b | 2.72x
bench_longest_common_substring_Stringy | 1,049.000μs | 2,152,320b | 2.81x

### benchmark: SuffixesAnsPrefixesBooleansBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_starts_with_any_Str | 376.000μs | 1,892,488b | 1.00x
bench_ends_with_Str | 395.000μs | 1,892,472b | 1.05x
bench_ends_with_any_Str | 426.000μs | 1,892,472b | 1.13x
bench_starts_with_Str | 427.000μs | 1,892,472b | 1.14x
bench_ends_with_Stringy | 900.000μs | 2,148,728b | 2.39x
bench_ends_with_any_Stringy | 905.000μs | 2,148,736b | 2.41x
bench_starts_with_Stringy | 919.000μs | 2,148,736b | 2.44x
bench_starts_with_any_Stringy | 979.000μs | 2,148,736b | 2.60x

### benchmark: ToBooleanBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_to_boolean_Str | 443.000μs | 1,892,432b | 1.00x
bench_to_boolean_Stringy | 1,006.000μs | 2,143,880b | 2.27x

### benchmark: TrimBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_both_Str | 416.000μs | 1,892,392b | 1.00x
bench_left_Str | 427.000μs | 1,892,392b | 1.03x
bench_right_Str | 430.000μs | 1,892,392b | 1.03x
bench_both_Stringy | 962.000μs | 2,145,448b | 2.31x
bench_right_Stringy | 1,097.000μs | 2,145,448b | 2.64x
bench_left_Stringy | 1,108.000μs | 2,145,448b | 2.66x

### benchmark: WhitespaceRelatedBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_strip_whitespace_Str | 407.000μs | 1,892,456b | 1.00x
bench_to_spaces_Str | 415.000μs | 1,892,440b | 1.02x
bench_collapse_whitespace_Str | 436.000μs | 1,892,456b | 1.07x
bench_to_tabs_Str | 501.000μs | 1,892,440b | 1.23x
bench_to_spaces_Stringy | 923.000μs | 2,146,488b | 2.27x
bench_collapse_whitespace_Stringy | 940.000μs | 2,146,504b | 2.31x
bench_to_tabs_Stringy | 1,025.000μs | 2,146,488b | 2.52x
bench_strip_whitespace_Stringy | 1,151.000μs | 2,146,496b | 2.83x