<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" import="java.sql.*"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DB Connection Test</title>
</head>
<body>
       <%
              String DB_URL = "jdbc:mysql://10.0.3.6:3306/testdatabase";   //database
              String DB_USER = "user01";  
              String DB_PASSWORD = "ncp123123";
              Connection conn;
              Statement stmt;
              PreparedStatement ps;
              ResultSet rs;
              try {
                     Class.forName("com.mysql.cj.jdbc.Driver");
                     conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
                     stmt = conn.createStatement();

                    /* SQL 처리 코드 추가 부분 */
                     ps = conn.prepareStatement("select * from customers;"); //Table   대문자로 명령실행시 CDB에서 에러 발생함
                     rs = ps.executeQuery();

                     while(rs.next()){
                         out.println(rs.getString(1)+"&nbsp"+rs.getString(2)+"&nbsp"+rs.getString(3)+"<br />");
                     }
                     conn.close();
                     out.println("MySQL JDBC Driver Connection Test Success!!!");
              } catch (Exception e) {
                     out.println(e.getMessage());
              }
       %>
</body>
</html>

