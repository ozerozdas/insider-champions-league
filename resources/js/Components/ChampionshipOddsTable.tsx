import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Progress } from "@/Components/ui/progress";

export default function ChampionshipOddsTable({ odds }: { odds: Array<{ name: string, odds: number }> }) {
    return (
        <Card className="w-full mx-auto mt-8 shadow-xl">
            <CardContent className="p-6">
                <h2 className="text-2xl font-bold mb-4">Championship Predictions</h2>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Team</TableHead>
                            <TableHead className="text-center">Odds (%)</TableHead>
                            <TableHead className="text-center">Visual</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {odds.map((team, index) => (
                            <TableRow key={index}>
                                <TableCell className="font-medium">{team.name}</TableCell>
                                <TableCell className="text-center">{team.odds}%</TableCell>
                                <TableCell className="text-center">
                                    <Progress value={team.odds} className="h-2" />
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    );
}
