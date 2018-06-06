-- Table structure for table `spell_dict_word_list`

CREATE TABLE IF NOT EXISTS /*_*/spell_dict_word_list (
	sd_word varchar(50) NOT NULL,

	-- Language to which the word belongs
	sd_language varchar(20) NOT NULL,

	sd_timestamp varbinary(14) NOT NULL,

	-- Name of the user who submitted the word
	sd_user varchar(40) NOT NULL

)/*$wgDBTableOptions*/;
