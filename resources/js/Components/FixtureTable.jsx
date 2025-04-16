import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";

export default function FixtureTable({ matches }) {
    return (
        <Card className="w-full max-w-4xl mx-auto mt-8 shadow-xl">
            <CardContent className="p-6">
                <h2 className="text-2xl font-bold mb-4">Fixture</h2>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead className="w-1/12 text-center">Week</TableHead>
                            <TableHead>Match</TableHead>
                            <TableHead className="text-center">Score</TableHead>
                            <TableHead className="text-center">Status</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {matches.map((match) => (
                            <TableRow key={match.id} className="hover:bg-muted/30 transition">
                                <TableCell className="text-center font-semibold">{match.week}</TableCell>
                                <TableCell>
                                    <span className="font-medium">
                                        {match.home_team.name} <span className="text-muted-foreground">vs</span> {match.away_team.name}
                                    </span>
                                </TableCell>
                                <TableCell className="text-center">
                                    {match.is_simulated
                                        ? `${match.home_score} - ${match.away_score}`
                                        : '--'}
                                </TableCell>
                                <TableCell className="text-center">
                                    <Badge variant={match.is_simulated ? 'default' : 'outline'}>
                                        {match.is_simulated ? 'Played' : 'Pending'}
                                    </Badge>
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    );
}