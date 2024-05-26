import java.sql.*;
import java.util.Comparator;
import java.util.PriorityQueue;

public class SQLPriorityQueueExample
 {

    // Define a class to represent items fetched from SQL
    static class Item {
        String taskName;
        int priority;
        String taskDate;
        String taskTime;

        public Item(String taskName, int priority, String taskDate, String taskTime) {
            this.taskName = taskName;
            this.priority = priority;
            this.taskDate = taskDate;
            this.taskTime = taskTime;
        }

        @Override
        public String toString() {
            return "Item{" +
                    "taskName='" + taskName + '\'' +
                    ", priority=" + priority +
                    ", taskDate='" + taskDate + '\'' +
                    ", taskTime='" + taskTime + '\'' +
                    '}';
        }
    }

    public static void main(String[] args) {
        // JDBC URL, username, and password for your SQL database
        String jdbcUrl = "jdbc:mysql://localhost:3303/mads";
        String username = "root";
        String password = "root";

        // SQL query to fetch data from the database
        String sqlQuery = "SELECT task_name, priority, task_date, task_time FROM tasks";

        // Create a priority queue to store items
        PriorityQueue<Item> priorityQueue = new PriorityQueue<>(new Comparator<Item>() {
            @Override
            public int compare(Item item1, Item item2) {
                // Compare items based on their priority
                return Integer.compare(item1.priority, item2.priority);
            }
        });

        try (Connection connection = DriverManager.getConnection(jdbcUrl, username, password);
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(sqlQuery)) {

            // Iterate through the result set and add items to the priority queue
            while (resultSet.next()) {
                String taskName = resultSet.getString("task_name");
                int priority = resultSet.getInt("priority");
                String taskDate = resultSet.getString("task_date");
                String taskTime = resultSet.getString("task_time");
                Item item = new Item(taskName, priority, taskDate, taskTime);
                priorityQueue.add(item);
            }

            // Print items from the priority queue
            while (!priorityQueue.isEmpty()) {
                Item item = priorityQueue.poll();
                System.out.println(item);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
