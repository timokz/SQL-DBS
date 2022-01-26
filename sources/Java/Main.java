package com.javaDBS;

import java.sql.*;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {

        try {
            // Loads the class "oracle.jdbc.driver.OracleDriver" into the memory
            Class.forName("oracle.jdbc.driver.OracleDriver");
            String database = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
            String user = "a11848158";
            String pass = "dbs21";
            Class.forName("oracle.jdbc.driver.OracleDriver");
            Connection con = DriverManager.getConnection(database, user, pass);
            Statement stmt = con.createStatement();

            Scanner sc = new Scanner(System.in);
            String table = "THEATRE";

            System.out.println("--------------VIENNA THEATRE DB---------------");
            System.out.println("SELECT TABLE by Number");
            System.out.println("1. Theatres");
            System.out.println("2. Performances");
            System.out.println("3. Audience Members");
            System.out.println("4. Tickets");
            System.out.println("5. Transactions");
            System.out.println("6. Box_Office");

            System.out.println("9: Exit");


            try {
                if(sc.hasNextInt()) {
                    switch (sc.nextInt()) {
                        case 1 -> gui(table = "THEATRE", stmt);
                        case 2 -> gui(table = "E_PERFORMANCE", stmt);
                        case 3 -> gui(table = "AUDIENCE_MEMBER", stmt);
                        case 4 -> gui(table = "TICKET", stmt);
                        case 5 -> gui(table = "TRANSACTION", stmt);
                        case 6 -> gui(table = "BOX_OFFICE", stmt);
                        case 9 -> System.exit(0);
                        default -> System.out.println("Please input a Number to select corresponding Table");
                    }
                }
            } catch (Exception e) {
                System.err.println("Error while executing SQL statement: " + e.getMessage());
            }

            ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM " + table);
            if (rs.next()) {
                int count = rs.getInt(1);
                System.out.println("Number of datasets: " + count);
                main(null);
            }
            // Clean up connections
            rs.close();
            stmt.close();
            con.close();
        } catch (Exception e) {
            System.err.println(e);
        }
    }

    public static void gui(String table, Statement stmt) throws SQLException {

        Scanner sc1 = new Scanner(System.in);
        System.out.println("SELECT OPTION");
        System.out.println("1. Read data from corresponding file");
        System.out.println("2. Delete table contents");
        System.out.println("3. Exit");
        int param = sc1.nextInt();
        if(param == 2) {
            int rowsAffected = 0;
            rowsAffected += stmt.executeUpdate("TRUNCATE TABLE "+ table);
            System.out.println("Rows affected: " + rowsAffected);
        }
        else if(param == 1){
            switch (table) {
                case "THEATRE" -> System.out.println("Rows affected: " + Theatre.statement(stmt));
                case "E_PERFORMANCE" -> System.out.println("Rows affected: " + Performance.statement(stmt));
                case "AUDIENCE_MEMBER" -> System.out.println("Rows affected: " + Audience.statement(stmt));
                case "TICKET" -> System.out.println("Rows affected: " + Ticket.statement(stmt));
                case "TRANSACTION" -> System.out.println("Rows affected: " + Transaction.statement(stmt));
                case "BOX_OFFICE" ->System.out.println("Rows affected: " + Box_office.statement(stmt));
                default -> {
                    System.out.println("Invalid Input");
                    gui(table, stmt);
                }
            }
        }
        else if (param == 3)
            main(null);
        else System.out.println("Please Select valid Option (1, 2 or 3 to exit)");

    }
}

