-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 12-06-29 12:57 
-- 서버 버전: 5.1.32
-- PHP 버전: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `dev_mb`
--

--
-- 테이블의 덤프 데이터 `m3_board`
--

INSERT INTO `m3_board` (`bo_no`, `bo_subject`, `bo_use_secret`, `bo_use_link`, `bo_del_comment`, `bo_mod_comment`, `bo_level_list`, `bo_level_view`, `bo_level_write`, `bo_level_modify`, `bo_level_delete`, `bo_use_category`, `bo_category`, `bo_use_file`, `bo_file_num`, `bo_file_level_list`, `bo_file_level_down`, `bo_file_level_upload`, `bo_use_comment`, `bo_comment_use_secret`, `bo_comment_level_write`, `bo_comment_level_delete`, `bo_editor`, `bo_admin_path`, `bo_kind`) VALUES
(1, '공지게시판', 0, 1, 0, 0, 1, 1, 2, 2, 2, 0, '[]', 1, 1, 1, 2, 2, 0, 0, 2, 2, 'cheditor', '/mb/?r=admin&amp;id1=%EA%B2%8C%EC%8B%9C%ED%8C%90%EA%B4%80%EB%A6%AC&amp;id2=%EA%B2%8C%EC%8B%9C%ED%8C%90+%EC%84%A4%EC%A0%95&amp;bo_no=1&amp;boardMode=write', ''),
(6, '사진게시판', 0, 0, 1, 1, 1, 1, 2, 2, 2, 1, '[{"data":"풍경","metadata":{}},{"data":"자연","metadata":{}}]', 1, 3, 1, 1, 2, 0, 0, 1, 1, 'cheditor', '/mb/?r=admin&amp;id1=%EA%B2%8C%EC%8B%9C%ED%8C%90%EA%B4%80%EB%A6%AC&amp;id2=%EA%B2%8C%EC%8B%9C%ED%8C%90+%EC%84%A4%EC%A0%95&amp;bo_no=6&amp;boardMode=write', ''),
(4, '자유게시판', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '[{"data":"잡담","metadata":{}},{"data":"건의","metadata":{}}]', 1, 2, 1, 1, 2, 0, 1, 1, 1, 'cheditor', '/mb/?r=admin&amp;id1=%EA%B2%8C%EC%8B%9C%ED%8C%90%EA%B4%80%EB%A6%AC&amp;id2=%EA%B2%8C%EC%8B%9C%ED%8C%90+%EC%84%A4%EC%A0%95&amp;bo_no=4&amp;boardMode=write', ''),
(5, '질문과답변', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '[{"data":"매직보드","state":"open","metadata":{},"children":[{"data":"설치","metadata":{}},{"data":"위젯","metadata":{}},{"data":"스킨제작 및 수정","metadata":{}}]},{"data":"웹모나","metadata":{}},{"data":"디피피아","metadata":{}},{"data":"기타","metadata":{}}]', 1, 1, 1, 1, 2, 0, 0, 1, 1, 'cheditor', '/mb/?r=admin&amp;id1=%EA%B2%8C%EC%8B%9C%ED%8C%90%EA%B4%80%EB%A6%AC&amp;id2=%EA%B2%8C%EC%8B%9C%ED%8C%90+%EC%84%A4%EC%A0%95&amp;bo_no=5&amp;boardMode=write', ''),
(7, 'popup//', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=3&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(8, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?page_edit=true&amp;wgMode=write&amp;wgaif_table=m3_write&amp;wgaif_kn=wr_no&amp;wgaif_key=71&amp;wgaif_field=wr_content&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(9, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=4&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(10, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=45&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(11, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=23&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(12, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=29&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(13, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=39&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(14, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=40&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(15, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=41&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(16, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=28&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(17, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=35&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(18, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=36&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(19, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=37&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(20, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=38&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page'),
(21, '페이지', 0, 0, 1, 1, 1, 1, 2, 2, 2, 0, '', 1, 2, 1, 1, 2, 1, 0, 1, 1, 'cheditor', '/mb/?wgMode=write&amp;wgaif_table=m3_magic&amp;wgaif_kn=m_no&amp;wgaif_key=30&amp;wgaif_field=m_contents&amp;wgSkin=page_list&amp;r=popup&amp;wgPage=write', 'page');

--
-- 테이블의 덤프 데이터 `m3_comment`
--

INSERT INTO `m3_comment` (`cmt_no`, `wr_no`, `cmt_parent_no`, `cmt_content`, `mb_no`, `cmt_writer`, `cmt_password`, `cmt_datetime`, `cmt_ip`, `cmt_is_secret`, `cmt_good`, `cmt_bad`) VALUES
(9, 57, 0, '손님이 댓글을 씁니다.', 0, '너구리', '*A4B6157319038724E3560894F7F932C8886EBFCF', '2012-06-21 16:19:01', 237672517, 0, 0, 0),
(10, 57, 9, '손님에 댓글을 댓글을 답니다.', 0, '너굴너굴', '*A4B6157319038724E3560894F7F932C8886EBFCF', '2012-06-21 16:19:24', 237672517, 0, 0, 0);

--
-- 테이블의 덤프 데이터 `m3_config`
--

INSERT INTO `m3_config` (`cf_id`, `cf_type`, `cf_value`, `cf_desc`) VALUES
('hp_title', 'str', '매직보드', '홈페이지 타이틀'),
('admin', 'str', 'admin', '최고관리자 아이디'),
('path_admin', 'str', 'admin', '관리자페이지 아이디'),
('path_member', 'str', '회원페이지', '회원페이지 아이디'),
('mb_pic_width', 'str', '44', '회원사진너비'),
('mb_pic_height', 'str', '40', '회원사진높이'),
('termsofuse', 'text', '이용약관 입니다.\r\n이용약관을 수정하려면 "관리자페이지>환경설정>회원관련"에서 수정하세요.\r\n\r\n샘플(일반적으로 많이 사용하는 약관형태이니 수정해 사용하세요)\r\n-------------------------------------------------------------\r\n\r\n제1장 총 칙\r\n\r\n제1조(목적)\r\n이 약관은 000(이하 "회사"라 한다)이 홈페이지(000000000)에서 제공하는 모든 서비스(이하 "서비스"라 한다)의 이용조건 및 절차에 관한 사항을 규정함을 목적으로 합니다. \r\n\r\n제2조(정의) \r\n이 약관에서 사용하는 용어의 정의는 다음 각 호와 같습니다. \r\n1. 이용자 : 본 약관에 따라 회사가 제공하는 서비스를 받는 자\r\n2. 이용계약 : 서비스 이용과 관련하여 회사와 이용자간에 체결하는 계약\r\n3. 가입 : 회사가 제공하는 신청서 양식에 해당 정보를 기입하고, 본 약관에 동의하여 서비스 이용계약을 완료시키는 행위\r\n4. 회원 : 당 사이트에 회원가입에 필요한 개인정보를 제공하여 회원 등록을 한 자\r\n5. 이용자번호(ID) : 회원 식별과 회원의 서비스 이용을 위하여 이용자가 선정하고 회사가 승인하는 영문자와 숫자의 조합(하나의 주민등록번호에 하나의 ID만 발급 가능함)\r\n6. 패스워드(PASSWORD) : 회원의 정보 보호를 위해 이용자 자신이 설정한 영문자와 숫자, 특수문자의 조합\r\n7. 이용해지 : 회사 또는 회원이 서비스 이용이후 그 이용계약을 종료시키는 의사표시\r\n\r\n제3조(약관의 효력과 변경)\r\n회원은 변경된 약관에 동의하지 않을 경우 회원 탈퇴(해지)를 요청할 수 있으며, 변경된 약관의 효력 발생일로부터 7일 이후에도 거부의사를 표시하지 아니하고 서비스를 계속 사용할 경우 약관의 변경 사항에 동의한 것으로 간주됩니다\r\n① 이 약관의 서비스 화면에 게시하거나 공지사항 게시판 또는 기타의 방법으로 공지함으로써 효력이 발생됩니다. \r\n② 회사는 필요하다고 인정되는 경우 이 약관의 내용을 변경할 수 있으며, 변경된 약관은 서비스 화면에 공지하며, 공지후 7일 이후에도 거부의사를 표시하지 아니하고 서비스를 계속 사용할 경우 약관의 변경 사항에 동의한 것으로 간주됩니다.\r\n③ 이용자가 변경된 약관에 동의하지 않는 경우 서비스 이용을 중단하고 본인의 회원등록을 취소할 수 있으며, 계속 사용하시는 경우에는 약관 변경에 동의한 것으로 간주되며 변경된 약관은 전항과 같은 방법으로 효력이 발생합니다.\r\n\r\n제4조(준용규정) \r\n이 약관에 명시되지 않은 사항은 전기통신기본법, 전기통신사업법 및 기타 관련법령의 규정에 따릅니다. \r\n\r\n제2장 서비스 이용계약\r\n\r\n제5조(이용계약의 성립) \r\n이용계약은 이용자의 이용신청에 대한 회사의 승낙과 이용자의 약관 내용에 대한 동의로 성립됩니다.\r\n\r\n제6조(이용신청) \r\n이용신청은 서비스의 회원정보 화면에서 이용자가 회사에서 요구하는 가입신청서 양식에 개인의 신상정보를 기록하여 신청할 수 있습니다. \r\n\r\n제7조(이용신청의 승낙)\r\n① 회원이 신청서의 모든 사항을 정확히 기재하여 이용신청을 하였을 경우에 특별한 사정이 없는 한 서비스 이용신청을 승낙합니다.\r\n② 다음 각 호에 해당하는 경우에는 이용 승낙을 하지 않을 수 있습니다. \r\n1. 본인의 실명으로 신청하지 않았을 때\r\n2. 타인의 명의를 사용하여 신청하였을 때\r\n3. 이용신청의 내용을 허위로 기재한 경우\r\n4. 사회의 안녕 질서 또는 미풍양속을 저해할 목적으로 신청하였을 때\r\n5. 기타 회사가 정한 이용신청 요건에 미비 되었을 때 \r\n\r\n제8조(계약사항의 변경) \r\n회원은 이용신청시 기재한 사항이 변경되었을 경우에는 수정하여야 하며, 수정하지 아니하여 발생하는 문제의 책임은 회원에게 있습니다.\r\n\r\n\r\n제3장 계약당사자의 의무\r\n\r\n제9조(회사의 의무) \r\n회사는 서비스 제공과 관련해서 알고 있는 회원의 신상 정보를 본인의 승낙 없이 제3자에게 누설하거나 배포하지 않습니다. 단, 전기통신기본법 등 법률의 규정에 의해 국가기관의 요구가 있는 경우, 범죄에 대한 수사상의 목적이 있거나 또는 기타 관계법령에서 정한 절차에 의한 요청이 있을 경우에는 그러하지 아니합니다.\r\n\r\n제10조(회원의 의무)\r\n① 회원은 서비스를 이용할 때 다음 각 호의 행위를 하지 않아야 합니다. \r\n1. 다른 회원의 ID를 부정하게 사용하는 행위 \r\n2. 서비스에서 얻은 정보를 복제, 출판 또는 제3자에게 제공하는 행위 \r\n3. 회사의 저작권, 제3자의 저작권 등 기타 권리를 침해하는 행위 \r\n4. 공공질서 및 미풍양속에 위반되는 내용을 유포하는 행위 \r\n5. 범죄와 결부된다고 객관적으로 판단되는 행위 \r\n6. 기타 관계법령에 위반되는 행위 \r\n② 회원은 서비스를 이용하여 영업활동을 할 수 없으며, 영업활동에 이용하여 발생한 결과에 대하여 회사는 책임을 지지 않습니다. \r\n③ 회원은 서비스의 이용권한, 기타 이용계약상 지위를 타인에게 양도하거나 증여할 수 없으며, 이를 담보로도 제공할 수 없습니다. \r\n\r\n\r\n제4장 서비스 이용 \r\n\r\n제11조(회원의 의무)\r\n① 회원은 필요에 따라 자신의 메일, 게시판, 등록자료 등 유지보수에 대한 관리책임을 갖습니다. \r\n② 회원은 회사에서 제공하는 자료를 임의로 삭제, 변경할 수 없습니다.\r\n③ 회원은 회사의 홈페이지에 공공질서 및 미풍양속에 위반되는 내용물이나 제3자의 저작권 등 기타권리를 침해하는 내용물을 등록하는 행위를 하지 않아야 합니다. 만약 이와 같은 내용물을 게재하였을 때 발생하는 결과에 대한 모든 책임은 회원에게 있습니다. \r\n\r\n제12조(게시물 관리 및 삭제) \r\n효율적인 서비스 운영을 위하여 회원의 메모리 공간, 메시지크기, 보관일수 등을 제한할 수 있으며 등록하는 내용이 다음 각 호에 해당하는 경우에는 사전 통지없이 삭제할 수 있습니다. \r\n1. 다른 회원 또는 제3자를 비방하거나 중상모략으로 명예를 손상시키는 내용인 경우\r\n2. 공공질서 및 미풍양속에 위반되는 내용인 경우 \r\n3. 범죄적 행위에 결부된다고 인정되는 내용인 경우 \r\n4. 회사의 저작권, 제3자의 저작권 등 기타 권리를 침해하는 내용인 경우 \r\n5. 회원이 회사의 홈페이지와 게시판에 음란물을 게재하거나 음란 사이트를 링크하는 경우 \r\n6. 기타 관계법령에 위반된다고 판단되는 경우 \r\n\r\n제13조(게시물의 저작권) \r\n게시물의 저작권은 게시자 본인에게 있으며 회원은 서비스를 이용하여 얻은 정보를 가공, 판매하는 행위 등 서비스에 게재된 자료를 상업적으로 사용할 수 없습니다. \r\n\r\n제14조(서비스 이용시간) \r\n서비스의 이용은 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴 1일 24시간을 원칙으로 합니다. 다만 정기 점검 등의 사유 발생시는 그러하지 않습니다.\r\n\r\n제15조(서비스 이용 책임) \r\n서비스를 이용하여 해킹, 음란사이트 링크, 상용S/W 불법배포 등의 행위를 하여서는 아니되며, 이를 위반으로 인해 발생한 영업활동의 결과 및 손실, 관계기관에 의한 법적 조치 등에 관하여는 회사는 책임을 지지 않습니다. \r\n\r\n제16조(서비스 제공의 중지) \r\n다음 각 호에 해당하는 경우에는 서비스 제공을 중지할 수 있습니다. \r\n1. 서비스용 설비의 보수 등 공사로 인한 부득이한 경우 \r\n2. 전기통신사업법에 규정된 기간통신사업자가 전기통신 서비스를 중지했을 경우 \r\n3. 시스템 점검이 필요한 경우\r\n4. 기타 불가항력적 사유가 있는 경우\r\n\r\n\r\n제5장 계약해지 및 이용제한\r\n\r\n제17조(계약해지 및 이용제한)\r\n① 회원이 이용계약을 해지하고자 하는 때에는 회원 본인이 인터넷을 통하여 해지신청을 하여야 하며, 회사에서는 본인 여부를 확인 후 조치합니다.\r\n② 회사는 회원이 다음 각 호에 해당하는 행위를 하였을 경우 해지조치 30일전까지 그 뜻을 이용고객에게 통지하여 의견진술할 기회를 주어야 합니다.\r\n1. 타인의 이용자ID 및 패스워드를 도용한 경우 \r\n2. 서비스 운영을 고의로 방해한 경우 \r\n3. 허위로 가입 신청을 한 경우\r\n4. 같은 사용자가 다른 ID로 이중 등록을 한 경우 \r\n5. 공공질서 및 미풍양속에 저해되는 내용을 유포시킨 경우 \r\n6. 타인의 명예를 손상시키거나 불이익을 주는 행위를 한 경우 \r\n7. 서비스의 안정적 운영을 방해할 목적으로 다량의 정보를 전송하거나 광고성 정보를 전송하는 경우 \r\n8. 정보통신설비의 오작동이나 정보 등의 파괴를 유발시키는 컴퓨터바이러스 프로그램 등을 유포하는 경우 \r\n9. 회사 또는 다른 회원이나 제3자의 지적재산권을 침해하는 경우 \r\n10. 타인의 개인정보, 이용자ID 및 패스워드를 부정하게 사용하는 경우 \r\n11. 회원이 자신의 홈페이지나 게시판 등에 음란물을 게재하거나 음란 사이트를 링크하는 경우 \r\n12. 기타 관련법령에 위반된다고 판단되는 경우\r\n\r\n\r\n제6장 기 타\r\n\r\n제18조(양도금지) \r\n회원은 서비스의 이용권한, 기타 이용계약상의 지위를 타인에게 양도, 증여할 수 없으며, 이를 담보로 제공할 수 없습니다.\r\n\r\n제19조(손해배상) \r\n회사는 무료로 제공되는 서비스와 관련하여 회원에게 어떠한 손해가 발생하더라도 동 손해가 회사의 고의 또는 중대한 과실로 인한 손해를 제외하고 이에 대하여 책임을 부담하지 아니합니다.\r\n\r\n제20조(면책 조항)\r\n① 회사는 천재지변, 전쟁 또는 기타 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 관한 책임이 면제됩니다.\r\n② 회사는 서비스용 설비의 보수, 교체, 정기점검, 공사 등 부득이한 사유로 발생한 손해에 대한 책임이 면제됩니다.\r\n③ 회사는 회원의 귀책사유로 인한 서비스이용의 장애에 대하여 책임을 지지 않습니다.\r\n④ 회사는 회원이 서비스를 이용하여 기대하는 이익이나 서비스를 통하여 얻는 자료로 인한 손해에 관하여 책임을 지지 않습니다.\r\n⑤ 회사는 회원이 서비스에 게재한 정보, 자료, 사실의 신뢰도, 정확성 등의 내용에 관하여는 책임을 지지 않습니다.\r\n\r\n제21조(관할법원) \r\n서비스 이용으로 발생한 분쟁에 대해 소송이 제기 될 경우 회사의 소재지를 관할하는 법원을 전속 관할법원으로 합니다. \r\n\r\n부 칙 \r\n(시행일) 이 약관은 2011 년 0월 00일부터 시행합니다.  \r\n', '회원가입약관'),
('privacyofuse', 'text', '개인정보 수집및 이용에 관한 안내 입니다.\r\n약관을 수정하려면 관리자페이지 "환경설정>회원관련"에서 수정하세요\r\n\r\n\r\n셈플\r\n-------------------------------------------------------------\r\n''000''은 (이하 ''회사''는)\r\n고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.\r\n\r\n회사는 개인정보취급방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.\r\n\r\n\r\n회사는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.\r\n\r\n■ 수집하는 개인정보 항목\r\n\r\n회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.\r\n\r\n\r\nο 수집항목 : 이름 , 생년월일 , 성별 , 로그인ID , 비밀번호 , 비밀번호 질문과 답변 , 이메일 , 서비스 이용기록 , 접속 로그 , 쿠키 , 접속 IP 정보 , 결제기록\r\nο 개인정보 수집방법 : 홈페이지(회원가입,게시판) \r\n\r\n■ 개인정보의 수집 및 이용목적\r\n\r\n회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다..\r\n\r\nο 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산\r\n콘텐츠 제공\r\nο 회원 관리\r\n회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 불량회원의 부정 이용 방지와 비인가 사용 방지 , 가입 의사 확인 , 연령확인 , 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인\r\nο 마케팅 및 광고에 활용\r\n접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계\r\n\r\n■ 개인정보의 보유 및 이용기간\r\n\r\n원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.\r\n\r\n\r\n보존 항목 : 로그인ID , 결제기록\r\n보존 근거 : 신용정보의 이용 및 보호에 관한 법률\r\n보존 기간 : 3년\r\n\r\n표시/광고에 관한 기록 : 6개월 (전자상거래등에서의 소비자보호에 관한 법률)\r\n계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)\r\n대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)\r\n소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)\r\n신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년 (신용정보의 이용 및 보호에 관한 법률)\r\n', '개인정보보호방침'),
('googleanalytics', 'text', '', '구글통계');

--
-- 테이블의 덤프 데이터 `m3_file`
--

INSERT INTO `m3_file` (`file_no`, `mb_no`, `wr_no`, `file_name`, `file_path`, `file_download`, `file_size`, `file_type`, `file_datetime`) VALUES
(9, 0, 57, 'Penguins.jpg', '/magic/data/file/00000_120621_152941_71fc.jpg', 2, 777835, 'image/jpeg', '2012-06-21 15:29:41'),
(7, 1, 51, 'aaa.gif', '/magic/data/file/00001_120620_090031_de67.gif', 0, 4713, 'image/gif', '2012-06-20 09:00:31'),
(10, 1, 89, 'Chrysanthemum.jpg', '/magic/data/file/00001_120629_110231_4292.jpg', 0, 879394, 'image/jpeg', '2012-06-29 11:02:31');

--
-- 테이블의 덤프 데이터 `m3_magic`
--

INSERT INTO `m3_magic` (`m_no`, `m_id`, `m_order`, `m_parent`, `m_layout`, `m_redirection`, `m_hidden`, `m_contents`, `m_image`, `m_desc`) VALUES
(1, 'kr', 0, 0, 'index', '', 0, '[[Widget|72]]', '', '홈페이지'),
(2, '매직보드 둘러보기', 0, 1, 'basic', './?r=kr&amp;id1=매직보드 둘러보기&amp;id2=설치 및 초기설정', 0, '[[Widget]]', '', ''),
(3, '설치 및 초기설정', 1, 2, 'basic', '', 0, '[[Widget|93]]', '', ''),
(4, '메뉴변경 및 디자인변경', 2, 2, 'basic', '', 0, '[[Widget|96]]', '', ''),
(5, '게시판', 4, 1, 'basic', './?r=kr&amp;id1=게시판&amp;id2=공지사항', 0, '[[Widget|13]]', '', ''),
(6, '공지사항', 5, 5, 'basic', '', 0, '[[Widget|73]]', '', ''),
(9, '회원페이지', 9, 1, 'member', '', 1, '', '', ''),
(47, '질문 및 답변', 7, 5, 'basic', '', 0, '[[Widget|75]]', '', ''),
(43, '일반게시판', 6, 5, 'basic', '', 0, '[[Widget|74]]', '', ''),
(23, 'admin', 0, 0, 'admin_index', '', 0, '[[Widget|98]]', 'menu_icon_00.png', '관리자'),
(24, '기본관리', 10, 23, 'admin', './?r=admin&amp;id1=기본관리&amp;id2=전체 최신글', 0, '[[Widget]]', 'menu_icon_01.png', ''),
(25, '환경설정', 18, 23, 'admin', './?r=admin&amp;id1=환경설정&amp;id2=기본환경변수', 0, '[[Widget|55]]', 'menu_icon_02.png', ''),
(26, '회원관리', 12, 23, 'admin', './?r=admin&amp;id1=회원관리&amp;id2=회원관리', 0, '[[Widget]]', 'menu_icon_03.png', ''),
(27, '게시판관리', 15, 23, 'admin', './?r=admin&amp;id1=게시판관리&amp;id2=게시판 설정', 0, '[[Widget]]', 'menu_icon_04.png', ''),
(28, '메뉴관리', 17, 23, 'admin_index', '', 0, '[[Widget|109]]', 'menu_icon_05.png', ''),
(29, '전체 최신글', 11, 24, 'admin', '', 0, '[[Widget|101]]', '', ''),
(30, 'Google Analytics', 23, 25, 'admin', '', 0, '[[Widget|119]]', '', ''),
(35, '기본환경변수', 19, 25, 'admin', '', 0, '[[Widget|111]]', '', ''),
(36, '회원관련', 20, 25, 'admin', '', 0, '[[Widget|113]]', '', ''),
(37, '홈페이지이용약관', 21, 25, 'admin', '', 0, '[[Widget|115]]', '', ''),
(38, '개인정보수집및이용', 22, 25, 'admin', '', 0, '[[Widget|117]]', '', ''),
(39, '회원관리', 13, 26, 'admin', '', 0, '[[Widget|103]]', '', ''),
(40, '탈퇴회원관리', 14, 26, 'admin', '', 0, '[[Widget|105]]', '', ''),
(41, '게시판 설정', 16, 27, 'admin', '', 0, '[[Widget|107]]', '', ''),
(45, '페이지 편집', 3, 2, 'basic', '', 0, '[[Widget|97]]', '', ''),
(48, '사진게시판', 8, 5, 'basic', '', 0, '[[Widget|121]]', '', '');

--
-- 테이블의 덤프 데이터 `m3_tag`
--

INSERT INTO `m3_tag` (`tag_no`, `bo_no`, `wr_no`, `mb_no`, `tag_name`) VALUES
(9, 6, 89, 1, '야'),
(8, 6, 89, 1, '태그'),
(7, 6, 89, 1, '태그도 가능함');

--
-- 테이블의 덤프 데이터 `m3_widget`
--

INSERT INTO `m3_widget` (`wg_no`, `wg_skin`, `wg_width`, `wg_width_unit`, `wg_param`) VALUES
(1, 'page', 100, '%', 'skin=admin_page[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(94, 'webclip', 100, '%', 'skin=breadcrumb'),
(75, 'page', 100, '%', 'skin=page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=13[]y=10[]wr_no=69'),
(81, 'webclip', 100, '%', 'skin=breadcrumb'),
(74, 'page', 100, '%', 'skin=page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=19[]y=17[]wr_no=68'),
(84, 'write', 100, '%', 'bo_no=4[]skin=basic[]img_width=500[]rows=20[]columns=no|wr_subject|wr_writer|wr_hit[]show_notice=1[]use_comment=1[]list_view=1[]x=24[]y=25'),
(13, 'page', 100, '%', 'wr_no=5[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(93, 'page_list', 100, '%', 'skin=page_list[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=25[]y=18[]bo_no=7'),
(73, 'page', 100, '%', 'skin=page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=40[]y=14[]wr_no=67'),
(87, 'webclip', 100, '%', 'skin=breadcrumb'),
(17, 'page', 100, '%', 'wr_no=7[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(18, 'page', 100, '%', 'wr_no=8[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(19, 'page', 100, '%', 'wr_no=9[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(21, 'page', 100, '%', 'wr_no=11[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(23, 'page', 100, '%', 'wr_no=13[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(25, 'page', 100, '%', 'wr_no=15[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(26, 'page', 100, '%', 'wr_no=16[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(27, 'page', 100, '%', 'wr_no=17[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(28, 'page', 100, '%', 'wr_no=18[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(29, 'page', 100, '%', 'wr_no=19[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(30, 'page', 100, '%', 'wr_no=20[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(31, 'page', 100, '%', 'wr_no=21[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(32, 'page', 100, '%', 'wr_no=22[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(33, 'page', 100, '%', 'wr_no=23[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(34, 'write', 100, '%', 'skin=mbasic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]use_comment=1[]show_notice=1[]bo_no=2'),
(35, 'page', 100, '%', 'wr_no=24[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(36, 'write', 100, '%', 'skin=mbasic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]use_comment=1[]show_notice=1[]bo_no=3'),
(37, 'page', 100, '%', 'wr_no=25[]editor=cheditor[]editor_width=100%[]editor_height=500px'),
(109, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=33[]y=20[]bo_no=16'),
(42, 'latest', 100, '%', 'bo_no=[]skin=all[]rows=5[]x=33[]y=22'),
(43, 'latest_member', 100, '%', 'skin=latest[]rows=5[]x=25[]y=15'),
(47, 'latest', 100, '%', 'bo_no=[]skin=all[]rows=5[]x=13[]y=11'),
(51, 'config', 100, '%', 'cf_id=googleanalytics[]x=26[]y=13'),
(52, 'page', 100, '%', 'skin=admin_page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=24[]y=14'),
(85, 'webclip', 100, '%', 'skin=breadcrumb'),
(83, 'webclip', 100, '%', 'skin=breadcrumb'),
(82, 'write', 100, '%', 'bo_no=5[]skin=basic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]show_notice=1[]use_comment=1[]x=37[]y=17[]list_view=0'),
(103, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=35[]y=5[]bo_no=13'),
(64, 'config', 100, '%', 'cf_id=hp_title,admin,path_member[]x=22[]y=20'),
(58, 'config', 100, '%', 'cf_id=mb_pic_width,mb_pic_height[]x=35[]y=6'),
(101, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=33[]y=20[]bo_no=12'),
(60, 'config', 100, '%', 'cf_id=termsofuse[]x=21[]y=21'),
(99, 'latest', 100, '%', 'bo_no=1[]skin=all[]rows=5[]x=34[]y=14'),
(62, 'config', 100, '%', 'cf_id=privacyofuse[]x=35[]y=13'),
(107, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=9[]y=9[]bo_no=15'),
(66, 'member', 100, '%', 'skin=admin[]x=42[]y=6'),
(68, 'member', 100, '%', 'skin=admin_unregisted[]x=37[]y=20'),
(105, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=29[]y=23[]bo_no=14'),
(70, 'board', 100, '%', 'skin=basic[]x=27[]y=5'),
(71, 'page', 100, '%', 'skin=admin_page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=38[]y=5'),
(72, 'latest', 100, '%', 'bo_no=1,4,5[]skin=tab[]rows=5[]x=26[]y=8'),
(80, 'menu', 100, '%', 'skin=admin[]x=29[]y=15'),
(86, 'write', 100, '%', 'bo_no=1[]skin=basic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]x=31[]y=14[]list_view=0[]show_notice=0[]use_comment=0'),
(108, 'board', 100, '%', 'skin=basic[]x=36[]y=20'),
(106, 'member', 100, '%', 'skin=admin_unregisted[]x=29[]y=13'),
(104, 'member', 100, '%', 'skin=admin[]x=31[]y=18'),
(102, 'latest', 100, '%', 'bo_no=1[]skin=all[]rows=5[]x=41[]y=25'),
(100, 'latest_member', 100, '%', 'skin=latest[]rows=5[]x=21[]y=26'),
(98, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=41[]y=13[]bo_no=11'),
(88, 'write', 100, '%', 'bo_no=1[]skin=basic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_hit[]x=16[]y=6[]list_view=0[]show_notice=0[]use_comment=0'),
(89, 'webclip', 100, '%', 'skin=breadcrumb'),
(90, 'write', 100, '%', 'bo_no=4[]skin=basic[]img_width=500[]rows=20[]columns=no|wr_subject|wr_datetime|wr_writer|wr_hit[]show_notice=1[]use_comment=1[]list_view=1[]x=21[]y=13'),
(91, 'webclip', 100, '%', 'skin=breadcrumb'),
(92, 'write', 100, '%', 'bo_no=5[]skin=basic[]img_width=500[]rows=20[]columns=no|wr_subject|wr_writer|wr_hit[]show_notice=1[]use_comment=1[]list_view=1[]x=18[]y=16'),
(96, 'page_list', 100, '%', 'skin=page_list[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=16[]y=5[]bo_no=9'),
(97, 'page_list', 100, '%', 'skin=page_list[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=25[]y=17[]bo_no=10'),
(110, 'menu', 100, '%', 'skin=admin[]x=42[]y=22'),
(111, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=32[]y=18[]bo_no=17'),
(112, 'config', 100, '%', 'cf_id=hp_title,admin[]x=44[]y=18'),
(113, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=25[]y=19[]bo_no=18'),
(114, 'config', 100, '%', 'cf_id=mb_pic_width,mb_pic_height[]x=35[]y=3'),
(115, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=32[]y=21[]bo_no=19'),
(116, 'config', 100, '%', 'cf_id=termsofuse[]x=29[]y=15'),
(117, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=18[]y=13[]bo_no=20'),
(118, 'config', 100, '%', 'cf_id=privacyofuse[]x=44[]y=12'),
(119, 'page_list', 100, '%', 'skin=page_admin[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=17[]y=5[]bo_no=21'),
(120, 'config', 100, '%', 'cf_id=googleanalytics[]x=20[]y=6'),
(121, 'page', 100, '%', 'skin=page[]editor=cheditor[]editor_width=100%[]editor_height=300px[]x=21[]y=21[]wr_no=88'),
(122, 'webclip', 100, '%', 'skin=breadcrumb'),
(123, 'gallery', 100, '%', 'bo_no=6[]skin=gallery[]img_width=500[]cols=4[]rows=3[]show_notice=1[]use_comment=1[]x=37[]y=6[]list_view=0');

--
-- 테이블의 덤프 데이터 `m3_write`
--

INSERT INTO `m3_write` (`wr_no`, `bo_no`, `wr_parent_no`, `wr_subject`, `wr_link`, `wr_content`, `wr_category`, `wr_hit`, `mb_no`, `wr_writer`, `wr_password`, `wr_datetime`, `wr_update`, `wr_ip`, `wr_state`, `wr_spam`, `wr_good`, `wr_bad`, `last_id`) VALUES
(54, 4, 0, '관리자에서 CSS를 수정할 수 있게 해주세요!!', 'http://www.webmona.com/', '이거도 필요합니다!!', '잡담', 2, 1, '최고관리자', '', '2012-06-21 15:12:12', '2012-06-21 15:12:12', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=일반게시판'),
(55, 4, 0, '아 다이어트 해야 하는데..', '', '왜 자꾸 치킨이 땡기죠?', '잡담', 1, 1, '최고관리자', '', '2012-06-21 15:21:18', '2012-06-21 15:21:18', 237672517, 2, 0, 0, 0, '?id1=게시판&id2=일반게시판'),
(48, 1, 0, '매직보드3는 완벽한 CMS툴을 지향합니다.', '', 'FTP로 접속하여 소스를 수정하지 않아도 모든 홈페이지 부분을 수정가능하도록<div>하는것이 최종목표입니다.</div>', '', 4, 1, '최고관리자', '', '2012-06-20 05:56:02', '2012-06-20 05:56:02', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=공지사항'),
(49, 1, 0, '위젯 개념을 도입하여 무한한 확장성을 고려하였습니다.', '', '누구나 위젯을 만들어 업로드하고 홈페이지에 적용할 수 있습니다.', '', 5, 1, '최고관리자', '', '2012-06-20 08:52:44', '2012-06-20 08:52:44', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=공지사항'),
(50, 1, 0, '위젯수정[Off]를 누르면 위젯편집이 가능합니다.', '', '위젯을 편집하여 마술같이 홈페이지를 변경해보세요', '', 5, 1, '최고관리자', '', '2012-06-20 08:53:34', '2012-06-20 08:53:34', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=공지사항'),
(51, 1, 0, '페이지수정[Off] 버튼을 누르면 페이지 수정이 가능합니다.', '', '페이지수정 버튼을 누르면<div>그자리에서 바로 페이지 수정이 가능합니다.</div>', '', 8, 1, '최고관리자', '', '2012-06-20 08:56:42', '2012-06-20 08:56:42', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=공지사항'),
(52, 4, 0, '자유롭게 글을 쓰는 곳입니다.', '', '욕설이나 남을 비방하는 글은 삭제될수 있습니다.', '잡담', 4, 1, '최고관리자', '', '2012-06-20 10:02:35', '2012-06-20 10:02:35', 237672517, 1, 0, 0, 0, '?r=kr&id1=게시판&id2=일반게시판'),
(53, 4, 0, '방문자 통계도 만들어 주세요!!', '', '꼭 필요해요...!!', '건의', 2, 1, '최고관리자', '', '2012-06-21 15:08:46', '2012-06-21 15:08:46', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=일반게시판'),
(2, 0, 0, 'page', '', '[[Widget|3]][[Widget|2]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(3, 0, 0, 'page', '', '[[Widget|6]][[Widget|5]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(4, 0, 0, 'page', '', '[[Widget|9]][[Widget|8]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(5, 0, 0, 'page', '', '[[Widget|12]][[Widget|11]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(6, 0, 0, 'page', '', '[[Widget|15]][[Widget|14]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(8, 0, 0, 'page', '', '', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(11, 0, 0, 'page', '', '[[Widget|20]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(13, 0, 0, 'page', '', '[[Widget|22]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(15, 0, 0, 'page', '', '[[Widget|24]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(17, 0, 0, 'page', '', '[[Widget|26]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(19, 0, 0, 'page', '', '[[Widget|28]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(69, 0, 0, '페이지(일반형)', '', '[[Widget|91]][[Widget|92]]', '', 0, 1, '페이지', '', '2012-06-26 18:06:04', '2012-06-26 18:06:04', 237672517, 0, 0, 0, 0, ''),
(73, 7, 0, '매직보드 초기설정', '', '매직보드 초기설정은 간단합니다.', 'h2', 0, 0, '페이지', '', '2012-06-26 20:36:17', '2012-06-26 20:36:17', 0, 0, 0, 0, 0, 'r=kr,id1=매직보드 둘러보기,id2=설치 및 초기설정'),
(68, 0, 0, '페이지(일반형)', '', '[[Widget|89]][[Widget|90]]', '', 0, 1, '페이지', '', '2012-06-26 18:03:42', '2012-06-26 18:03:42', 237672517, 0, 0, 0, 0, ''),
(67, 0, 0, '페이지(일반형)', '', '[[Widget|87]][[Widget|88]]', '', 0, 1, '페이지', '', '2012-06-26 17:50:56', '2012-06-26 17:50:56', 237672517, 0, 0, 0, 0, '?r=popup'),
(85, 21, 0, 'Google Analytics', '', '[[Widget|120]]', '', 0, 0, '페이지', '', '2012-06-27 06:55:57', '2012-06-27 06:55:57', 0, 0, 0, 0, 0, '?r=admin&id1=환경설정&id2=Google Analytics'),
(88, 0, 0, '페이지(일반형)', '', '[[Widget|122]][[Widget|123]]', '', 0, 1, '페이지', '', '2012-06-29 09:33:39', '2012-06-29 09:33:39', 237672517, 0, 0, 0, 0, ''),
(89, 6, 0, '갤러리 게시판을 생성하였습니다.', '', '1234', '자연', 1, 1, '최고관리자', '', '2012-06-29 11:02:31', '2012-06-29 11:02:31', 237672517, 1, 0, 0, 0, '?id1=게시판&id2=사진게시판'),
(21, 0, 0, 'page', '', '[[Widget|30]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(82, 18, 0, '회원관련', '', '[[Widget|114]]', '', 0, 0, '페이지', '', '2012-06-27 06:53:42', '2012-06-27 06:53:42', 0, 0, 0, 0, 0, 'r=admin,id1=환경설정,id2=회원관련'),
(57, 4, 0, '빨리 안정화 시켜주세요~~', '', '이미지도 가능합니다!!<div><br /></div><div>파일관련 클래스도 안정화 시켜야 합니다.</div><div>할게 무지 많은 달이네요..^^</div>', '잡담', 7, 0, '너구리', '*A4B6157319038724E3560894F7F932C8886EBFCF', '2012-06-21 15:29:41', '2012-06-21 15:29:41', 237672517, 0, 0, 0, 0, '?id1=게시판&id2=일반게시판'),
(58, 5, 0, '모든 질문은 여기에 해주세요.', '', '다양한 질문들을 하실 수 있습니다.', '기타', 3, 1, '최고관리자', '', '2012-06-21 16:45:00', '2012-06-21 16:45:00', 237672517, 1, 0, 0, 0, '?r=kr&id1=게시판&id2=질문 및 답변'),
(59, 5, 0, '설치 하는 방법?', '', '<div><br /></div>1. 압축된 파일을 다운 받아서 FTP계정에 업로드 하세요.<div>2. 압축을 풀고 magic폴더 퍼미션을 707로 변경하세요.</div><div>3. 브라우저를 통해 매직보드 압축을 푼 폴더에 접근하세요.</div><div>4. 설치화면에서 요구하는 정보를 입력하세요.</div><div>5. 마직막에 설치하기 버튼을 클릭하면 설치가 완료 됩니다.</div>', '매직보드|설치', 3, 1, '최고관리자', '', '2012-06-21 16:50:03', '2012-06-21 16:50:03', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=질문 및 답변'),
(60, 5, 0, '위젯이란?', '', '매직보드에서 위젯이란?<div><br /></div><div>웨젯의 개념은 아주 간단합니다.</div><div><br /></div><div>매직보드에서 게시판을 호출하거나</div><div>최신글을 호출하거나</div><div>특정한 기능을 호출하기 위해서는</div><div>PHP 클래스나 함수를 알아야 호출할 수 있습니다.</div><div><br /></div><div>그러나 프로그래머가 아닌 이상 이런 호출과정을 알아서 PHP소스를 수정해가며</div><div>제작할 수 없습니다.</div><div><br /></div><div>그것을 돕기 위해 위젯이라는 기능이 추가되었습니다.</div><div>게시판이나 다양한 기능들을 호출하는 방법을 위젯화 시켜서</div><div>간단한 클릭만으로 위젯을 추가할 수 있습니다.</div><div><br /></div><div>페이지 게시판 내부에서 [[Widget]]이라고 입력하고 저장하면 위젯추가 버튼이 생기고,</div><div>다양한 위젯중에 하나를 선택하여 원하는 기능을 구현할수 있습니다.</div><div><div><br /></div><div><br /></div></div>', '매직보드|위젯', 2, 1, '최고관리자', '', '2012-06-21 16:59:14', '2012-06-21 16:59:14', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=질문 및 답변'),
(23, 0, 0, 'page', '', '[[Widget|32]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(24, 0, 0, 'page', '', '[[Widget|34]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(25, 0, 0, 'page', '', '[[Widget|36]]', '', 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, ''),
(84, 20, 0, '개인정보수집 및 이용', '', '[[Widget|118]]', '', 0, 0, '페이지', '', '2012-06-27 06:55:16', '2012-06-27 06:55:16', 0, 0, 0, 0, 0, 'r=admin,id1=환경설정,id2=개인정보수집및이용'),
(29, 0, 0, '전체 최신글', '', '[[Widget|45]]', '', 0, 0, '페이지', '', '2012-06-12 17:35:50', '2012-06-12 17:35:50', 0, 0, 0, 0, 0, 'r=admin,id1=기본관리'),
(83, 19, 0, '홈페이지이용약관', '', '[[Widget|116]]', '', 0, 0, '페이지', '', '2012-06-27 06:54:25', '2012-06-27 06:54:25', 0, 0, 0, 0, 0, 'r=admin,id1=환경설정,id2=홈페이지이용약관'),
(74, 11, 0, '최근게시글', '', '[[Widget|99]]', '', 0, 0, '페이지', '', '2012-06-27 05:25:32', '2012-06-27 05:25:32', 0, 0, 0, 0, 0, 'r=admin'),
(56, 4, 0, '일반게시판은 비회원도 쓸수 있네요?', '', '멋져부러~~', '잡담', 5, 0, '너구리', '*A4B6157319038724E3560894F7F932C8886EBFCF', '2012-06-21 15:28:45', '2012-06-21 15:28:45', 237672517, 0, 0, 0, 0, '?id1=게시판&id2=일반게시판'),
(81, 17, 0, '기본환경변수', '', '[[Widget|112]]', '', 0, 0, '페이지', '', '2012-06-27 06:52:39', '2012-06-27 06:52:39', 0, 0, 0, 0, 0, 'r=admin,id1=환경설정,id2=기본환경변수'),
(80, 16, 0, '메뉴 및 디자인변경', '', '[[Widget|110]]', '', 0, 0, '페이지', '', '2012-06-27 06:51:59', '2012-06-27 06:51:59', 0, 0, 0, 0, 0, 'r=admin,id1=메뉴관리'),
(79, 15, 0, '게시판설정', '', '[[Widget|108]]', '', 0, 0, '페이지', '', '2012-06-27 06:51:04', '2012-06-27 06:51:04', 0, 0, 0, 0, 0, 'r=admin,id1=게시판관리,id2=게시판 설정'),
(75, 11, 0, '최근가입멤버', '', '[[Widget|100]]', '', 0, 0, '페이지', '', '2012-06-27 05:26:49', '2012-06-27 05:26:49', 0, 0, 0, 0, 0, 'r=admin'),
(76, 12, 0, '전체 최신글', '', '[[Widget|102]]', '', 0, 0, '페이지', '', '2012-06-27 06:48:49', '2012-06-27 06:48:49', 0, 0, 0, 0, 0, 'r=admin,id1=기본관리,id2=전체 최신글'),
(77, 13, 0, '회원관리', '', '[[Widget|104]]', '', 0, 0, '페이지', '', '2012-06-27 06:49:51', '2012-06-27 06:49:51', 0, 0, 0, 0, 0, 'r=admin,id1=회원관리,id2=회원관리'),
(78, 14, 0, '탈퇴회원관리', '', '[[Widget|106]]', '', 0, 0, '페이지', '', '2012-06-27 06:50:30', '2012-06-27 06:50:30', 0, 0, 0, 0, 0, 'r=admin,id1=회원관리,id2=탈퇴회원관리'),
(44, 1, 0, '매직보드 3.x 버전이 출시 되었습니다.', 'http://www.webmona.com/', '많은 이용 부탁 드립니다.', '', 12, 1, '최고관리자', '', '2012-06-15 07:28:38', '2012-06-15 07:28:38', 237672517, 0, 0, 0, 0, '?r=kr&id1=게시판&id2=공지사항'),
(70, 7, 0, '', '', '[[Widget|94]]', 'h2', 0, 0, '페이지', '', '2012-06-26 20:33:49', '2012-06-26 08:34:30', 0, 0, 0, 0, 0, 'r=kr,id1=매직보드 둘러보기,id2=설치 및 초기설정'),
(71, 7, 0, '매직보드 설치', '', '매직보드 설치방법입니다.', 'h2', 0, 0, '페이지', '', '2012-06-26 20:34:20', '2012-06-26 08:34:31', 0, 0, 0, 0, 0, 'r=kr,id1=매직보드 둘러보기,id2=설치 및 초기설정');
