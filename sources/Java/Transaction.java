package com.javaDBS;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class Transaction {

    int TRANSACTION_ID;
    String PAYMENT_METHOD;
    String T_DATE;
    int AMOUNT;
    String bname;

    public Transaction(int TRANSACTION_ID, String PAYMENT_METHOD, String t_DATE, int AMOUNT, String bname) {
        this.TRANSACTION_ID = TRANSACTION_ID;
        this.PAYMENT_METHOD = PAYMENT_METHOD;
        T_DATE = t_DATE;
        this.AMOUNT = AMOUNT;
        this.bname= bname;
    }
    public String insertion(){
        return "INSERT INTOTRANSACTION VALUES (" + TRANSACTION_ID + ", '" + PAYMENT_METHOD + "', timestamp '" + T_DATE + "','" + AMOUNT +  "','" + bname  + "')";
    }
    public static int statement(Statement stmt) throws SQLException {
        ArrayList<Transaction> transactions = FileRead.TransactionRead();
        int rowsAffected = 0;
        for(Transaction arg : transactions) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}